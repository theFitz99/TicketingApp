<?php

namespace App\Listeners;

use App\Events\CompletedTicket;
use App\Mail\CompletedTicketMail;
use App\Models\Contacts;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCompletedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CompletedTicket  $event
     * @return void
     */
    public function handle(CompletedTicket $event)
    {
        $contact = Contacts::query()->find($event->contactId);
        Mail::to($contact->email)->send(new CompletedTicketMail($contact, $event->ticketId));
    }
}
