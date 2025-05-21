<?php
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportingManagerMail;

if (!function_exists('sendReportingManagerMail')) {
    function sendReportingManagerMail($email, $subject, $type)
    {
        try {
            Mail::to($email)->send(new ReportingManagerMail($type, $subject));
            return true;
        } catch (\Exception $e) {
            \Log::error("Failed to send Reporting Manager Mail: " . $e->getMessage());
            return false;
        }
    }
}