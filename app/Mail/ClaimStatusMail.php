<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClaimStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($status, $name)
    {
        $this->status = $status;
        $this->name = $name;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Claim Timesheet Status Update')
            ->view('emails.claim_status')
            ->with([
                'status' => $this->status,
                'name' => $this->name,
            ]);
    }
}
