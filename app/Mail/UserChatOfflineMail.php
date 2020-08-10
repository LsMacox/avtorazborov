<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserChatOfflineMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user; 
    protected $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $msg)
    {
        $this->user = $user;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.userChatOfflineMail')
            ->with([
                'user' => $this->user,
                'msg' => $this->msg,
            ])
            ->subject('Авторазборов.рф');
    }
}
