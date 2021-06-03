<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Opened ticket list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($tickets->isNotEmpty())
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if(session()->has('ticket_deleted'))
                            <div class="alert alert-success">
                                {{ session()->get('ticket_deleted') }}
                            </div>
                        @endif
                        @if(session()->has('ticket_created'))
                            <div class="alert alert-success">
                                {{ session()->get('ticket_created') }}
                            </div>
                        @endif
                        <form action="{{ route('search.open.tickets') }}" method="GET" autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="searchTicketName">Ticket's title</label>
                                    <input type="text" name="searchTicketName" id="searchTicketName" class="form-control @error('searchTicketName') is-invalid @enderror" placeholder="Ticket's title">
                                    <small class="text-danger">{{ $errors->first('searchTicketName') }}</small>
                                </div>
                            </div>
                            <input type="submit" value="Search" class="btn btn-primary" name="searchBtn" id="searchBtn">
                        </form>
                    </div>
                    @foreach($tickets as $ticket)
                        <div class="p-6 bg-red-200 border-b-4 border-gray-200">
                            <h4><span class="text-muted">Ticket ({{ $ticket->ticket_type->description  }}): </span><a href="{{route('ticket.details', $ticket->id)}}">{{ $ticket->title }}</a></h4>
                            <h4><span class="text-muted">Contact: </span> <a href="{{ route('contact.details', $ticket->contact->id) }}"> {{ $ticket->contact->first_name }} {{ $ticket->contact->last_name }}</a></h4>
                        </div>
                    @endforeach
                    @if($tickets->hasPages())
                        <div class="p-6 bg-white">
                            {{ $tickets->withQueryString()->links() }}
                        </div>
                    @endif
                @else
                    <div class="p-6 bg-white">
                        <h4>There is no tickets!</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
