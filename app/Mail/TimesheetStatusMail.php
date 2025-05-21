<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimesheetStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $name;

    public function __construct($status, $name)
    {
        $this->status = $status;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Timesheet Status Update')
            ->view('emails.timesheet_status')
            ->with([
                'status' => $this->status,
                'name' => $this->name,
            ]);
    }
}
