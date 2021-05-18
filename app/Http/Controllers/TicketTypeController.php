<?php

namespace App\Http\Controllers;

use App\Models\Ticket_type;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket-type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ticket_type::query()->create($this->validateTicketType($request));

        return redirect('/tickets/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket_type  $ticket_type
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket_type $ticket_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket_type  $ticket_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket_type $ticket_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket_type  $ticket_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket_type $ticket_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket_type  $ticket_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket_type $ticket_type)
    {
        //
    }

    protected function validateTicketType(Request $request)
    {
        return $request->validate([
            'description' => 'required',
        ]);
    }
}
