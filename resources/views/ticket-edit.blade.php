<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('ticket.details', $ticket->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Ticket title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $ticket->title }}">
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Ticket description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" style="resize: none">{{ $ticket->description }}</textarea>
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                <input type="hidden" value="{{ $ticket->user->id }}" name="user_id">
                                <input type="hidden" value="{{ $ticket->contact->id }}" name="contact_id">
                                <input type="hidden" value="{{ $ticket->ticket_type->id }}" name="type_id">
                            </div>
                            @if(!$ticket->is_done)
                            <div class="form-group col-md-12">
                                <input type="checkbox" name="is_done" id="is_done" value="1">
                                <label for="is_done">Check if ticket is done</label>
                            </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
