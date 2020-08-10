<?php

namespace App\Mail;

use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProposalAlertRightAway extends Mailable
{
    use Queueable, SerializesModels;

    public $proposals;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proposals)
    {
        $this->proposals = $proposals;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Заявки с авторазбор.рф')
            ->view('emails.mail_list_proposal_right_away')->with(['proposals' => $this->proposals]);
    }
}
