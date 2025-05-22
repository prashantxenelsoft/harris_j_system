<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function __construct($type, $subjectText, $token, $selectedYear, $selectedMonth)
    {
        $this->type = $type;
        $this->subjectText = $subjectText;
        $this->token = $token;
        $this->selectedYear = $selectedYear;
        $this->selectedMonth = $selectedMonth;

        $this->consultant = DB::table('consultants')->where('token', $token)->first();
        $this->dashboards = collect();
        $this->client = null;
        $this->consultancy = null;
        $this->totalWorkingHours = 0;

        if ($this->consultant) {
            $this->dashboards = DB::table('consultant_dashboard')
                ->where('user_id', $this->consultant->user_id)
                ->where('type', 'timesheet')
                ->where('status', 'Submitted')
                ->get();

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
            'totalWorkingHours' => $this->totalWorkingHours,
        ];
        $data['isPdf'] = true;
        $pdf = Pdf::loadView('emails.reporting_manager', $data);
        $data['isPdf'] = false;
        return $this->view('emails.reporting_manager_body')
            ->subject($this->subjectText)
            ->with($data)
            ->attachData($pdf->output(), 'Timesheet.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
