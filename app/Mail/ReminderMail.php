<?php

namespace App\Mail;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reminder;
    public $actionUrl;

    /**
     * Create a new message instance.
     *
     * @param Reminder $reminder
     * @param string $actionUrl
     */
    public function __construct(Reminder $reminder, string $actionUrl)
    {
        $this->reminder = $reminder;
        $this->actionUrl = $actionUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(ucfirst($this->reminder->reminder_type) . ' Reminder Notification')
                    ->view('emails.reminder')
                    ->with([
                        'reminder' => $this->reminder,
                        'actionUrl' => $this->actionUrl,
                    ]);
    }
}
