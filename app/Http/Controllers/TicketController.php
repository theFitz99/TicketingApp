<?php

namespace App\Http\Controllers;

use App\Events\AddedTicket;
use App\Events\CompletedTicket;
use App\Models\Contacts;
use App\Models\Ticket;
use App\Models\Ticket_type;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOpen()
    {
        if (\Auth::user()->is_admin) {
            $tickets = Ticket::query()->whereNull('is_done')->latest()->paginate(10);
        } else {
            $tickets = User::query()->find(\Auth::id())->tickets()->whereNull('is_done')->paginate(10);
        }

        return view('ticket-open-list', compact('tickets'));
    }

    public function indexClosed()
    {
        if (\Auth::user()->is_admin) {
            $tickets = Ticket::query()->whereNotNull('is_done')->latest()->paginate(10);
        } else {
            $tickets = User::query()->find(\Auth::id())->tickets()->whereNotNull('is_done')->paginate(10);
        }

        return view('ticket-closed-list', compact('tickets'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Ticket_type::query()->get();
        return view('ticket-create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ticket::query()->create($this->validateTicket($request));
        AddedTicket::dispatch($request->input('contact_id'));

        return redirect('/open_tickets')->with('ticket_created', 'Ticket successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('ticket-details', compact('ticket'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket-edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        Ticket::query()->where('id', $ticket->id)->update($this->validateTicket($request));
        if ($request->input('is_done'))
        {
            CompletedTicket::dispatch($request->input('contact_id'), $ticket->id);
        }

        return redirect('/tickets/' . $ticket->id)->with('ticket_updated', 'Ticket information successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect('/open_tickets')->with('ticket_deleted', 'Ticket successfully deleted!');;
    }

    public function searchOpen(Request $request)
    {
        $request->validate([
            'searchTicketName' => 'required',
        ]);

        $ticketName = $request->input('searchTicketName');

        if (\Auth::user()->is_admin) {
            $tickets = Ticket::query()->where(function ($query) use ($ticketName) {
                $query->where('title', 'LIKE', "%{$ticketName}%")
                    ->whereNull('is_done');
            })->latest()->paginate(10);
        } else {
            $tickets = Ticket::query()->where('user_id', \Auth::id())->where(function ($query) use ($ticketName) {
                $query->where('title', 'LIKE', "%{$ticketName}%")
                    ->whereNull('is_done');
            })->latest()->paginate(10);
        }

        return view('ticket-open-list', compact('tickets'));
    }

    public function searchClosed(Request $request)
    {
        $request->validate([
            'searchTicketName' => 'required',
        ]);

        $ticketName = $request->input('searchTicketName');

        if (\Auth::user()->is_admin) {
            $tickets = Ticket::query()->where(function ($query) use ($ticketName) {
                $query->where('title', 'LIKE', "%{$ticketName}%")
                    ->whereNotNull('is_done');
            })->latest()->paginate(10);
        } else {
            $tickets = Ticket::query()->where('user_id', \Auth::id())->where(function ($query) use ($ticketName) {
                $query->where('title', 'LIKE', "%{$ticketName}%")
                    ->whereNotNull('is_done');
            })->latest()->paginate(10);
        }

        return view('ticket-closed-list', compact('tickets'));
    }

    protected function validateTicket(Request $request)
    {
        return $request->validate([
            'type_id' => 'required',
            'title' => 'required|max:70',
            'description' => 'required|min:10|max:600',
            'contact_id' => 'required',
            'user_id' => 'required',
            'is_done' => 'nullable'
        ]);
    }
}
