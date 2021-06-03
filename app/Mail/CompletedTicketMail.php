<?php

namespace App\Mail;

use App\Models\Contacts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompletedTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $contact;
    public $ticketId;
    public function __construct(Contacts $contact, String $ticketId)
    {
        $this->contact = $contact;
        $this->ticketId = $ticketId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ticket request #' . $this->ticketId . ' - Done')
            ->from('ticketing@app.com')
            ->view('ticket-completed-mail');
    }
}
