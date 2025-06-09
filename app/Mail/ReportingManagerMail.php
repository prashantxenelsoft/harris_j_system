<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportingManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $subjectText;
    public $token;
    public $selectedYear;
    public $selectedMonth;
    public $consultant;
    public $client;
    public $consultancy;
    public $dashboards;
    public $totalWorkingHours;
    public $claimsByMonth;

    public function __construct($type = 'timesheet', $subjectText, $token, $selectedYear, $selectedMonth)
    {
        $this->type = $type;
        $this->subjectText = $subjectText;
        $this->token = $token;
        $this->selectedYear = $selectedYear;
        $this->selectedMonth = $selectedMonth;

        $this->consultant = DB::table('consultants')->where($type === 'claims' ? 'claim_token' : 'token', $token)->first();
        $this->dashboards = collect();
        $this->client = null;
        $this->consultancy = null;
        $this->totalWorkingHours = 0;
        $this->claimsByMonth = [];

        if ($this->consultant) {
            $this->dashboards = DB::table('consultant_dashboard')
                ->where('user_id', $this->consultant->user_id)
                ->where('type', $this->type)
                ->where('status', 'Submitted')
                ->get();

            if ($this->type === 'timesheet') {
                foreach ($this->dashboards as $dashboard) {
                    $records = json_decode($dashboard->record, true);
                    if (is_array($records)) {
                        foreach ($records as $item) {
                            if (!empty($item['workingHours'])) {
                                $this->totalWorkingHours += floatval($item['workingHours']);
                            }
                        }
                    }
                }
            } elseif ($this->type === 'claims') {
                foreach ($this->dashboards as $record) {
                    $decoded = json_decode($record->record, true);
                    $entries = (is_array($decoded) && isset($decoded[0])) ? $decoded : (is_array($decoded) ? [$decoded] : []);

                    foreach ($entries as $data) {
                        if (!empty($data['applyOnCell'])) {
                            $dateStr = preg_replace('/\s*\/\s*/', '-', trim($data['applyOnCell']));
                            try {
                                $date = Carbon::createFromFormat('d-m-Y', $dateStr);
                            } catch (\Exception $e) {
                                continue;
                            }

                            $monthYear = $date->format('m_Y');
                            $day = (int)$date->format('d');

                            $this->claimsByMonth[$monthYear][$day][] = [
                                'type' => strtolower(trim($data['expenseType'] ?? 'other')),
                                'claim_no' => $data['claim_no'] ?? '',
                                'amount' => $data['amount'] ?? '',
                                'particulars' => $data['particulars'] ?? '',
                                'remarks' => $data['remarks'] ?? '',
                            ];
                        }
                    }
                }
            }

            $this->client = DB::table('clients')->where('id', $this->consultant->client_id)->first();
            if ($this->client && !empty($this->client->user_id)) {
                $this->consultancy = DB::table('users')->where('id', $this->client->user_id)->first();
            }
        }
    }

    public function build()
    {
        $data = [
            'type' => $this->type,
            'token' => $this->token,
            'consultant' => $this->consultant,
            'client' => $this->client,
            'consultancy' => $this->consultancy,
            'dashboards' => $this->dashboards,
            'selectedYear' => $this->selectedYear,
            'selectedMonth' => $this->selectedMonth,
            'totalWorkingHours' => $this->type === 'timesheet' ? $this->totalWorkingHours : null,
            'claimsByMonth' => $this->type === 'claims' ? $this->claimsByMonth : [],
        ];

        $data['isPdf'] = true;
        $pdfView = $this->type === 'claims' ? 'emails.claims_timesheet_reporting_manager_body' : 'emails.reporting_manager';
        $pdf = Pdf::loadView($pdfView, $data);
        $data['isPdf'] = false;

        $mailView = $this->type === 'claims' ? 'emails.claims_timesheet_reporting_manager_body' : 'emails.reporting_manager_body';

        return $this->view($mailView)
            ->subject($this->subjectText)
            ->with($data)
            ->attachData($pdf->output(), ucfirst($this->type) . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
