<?php

namespace App\Listeners;

use App\Events\AddedTicket;
use App\Mail\AddedTicketMail;
use App\Models\Contacts;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail
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
     * @param  AddedTicket  $event
     * @return void
     */
    public function handle(AddedTicket $event)
    {
       $contact = Contacts::query()->find($event->contactId);
       Mail::to($contact->email)->send(new AddedTicketMail($contact));
    }
}
