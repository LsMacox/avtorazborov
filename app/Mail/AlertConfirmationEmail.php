<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $proposals;
    public $urls;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $proposals, $urls)
    {
        $this->email = $email;
        $this->proposals = $proposals;
        $this->urls = $urls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Авторазборов.рф')
            ->view('emails.confirmed_alert');
    }
}
