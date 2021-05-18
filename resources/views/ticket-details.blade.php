<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session()->has('ticket_updated'))
                        <div class="alert alert-success">
                            {{ session()->get('ticket_updated') }}
                        </div>
                    @endif
                    <h4><span class="text-muted">Type: </span>{{ $ticket->ticket_type->description }}</h4>
                    <h4><span class="text-muted">Title: </span>{{ $ticket->title }}</h4>
                    <h4><span class="text-muted">Description: </span>{{ $ticket->description }}</h4>
                    <h4><span class="text-muted">Contact: </span><a href="{{ route('contact.details', $ticket->contact->id) }}">{{ $ticket->contact->first_name }} {{ $ticket->contact->last_name }}</a></h4>
                    @if (\Auth::user()->is_admin)
                        <h4><span class="text-muted">User: </span><a href="{{ route('user.details', $ticket->user->id) }}"> {{ $ticket->user->name }}</a></h4>
                    @endif
                    <h4><span class="text-muted">Status: </span>@if($ticket->is_done)<span style="color: green">Done</span> @else <span style="color: red">Not done yet</span> @endif</h4>
                    @if(!$ticket->is_done)
                    <br>
                    <form method="POST" action="{{ route('ticket.details', $ticket->id) }}">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-warning" href="{{ route('ticket.edit', $ticket->id) }}">Edit ticket</a>
                        <input type="submit" onclick="return confirm('Are you sure you want to delete this ticket?');" class="btn btn-danger" value="Delete ticket">
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
