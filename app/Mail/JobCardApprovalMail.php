<?php

namespace App\Mail;

use App\Models\JobCard;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobCardApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobcard;

    public function __construct(JobCard $jobcard)
    {
        $this->jobcard = $jobcard;
    }

    public function build()
    {
        return $this->subject('Job Card Approval Request')
                    ->view('emails.jobcard.approval')
                    ->with([
                        'jobcard' => $this->jobcard
                    ]);
    }
}
