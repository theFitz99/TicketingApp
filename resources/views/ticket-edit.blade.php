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
                        @if(\Auth::user()->is_admin)
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="user_id">Assigned to</label>
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    <option value="{{ $ticket->user->id }}" selected>{{ $ticket->user->name }}</option>
                                    @foreach(\App\Models\User::query()->where("id", "!=", $ticket->user->id)->get() as $user)
                                        <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('user_id') }}</p>
                            </div>
                        </div>
                        @endif
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
                                <input type="hidden" value="{{ $ticket->contact->id }}" name="contact_id">
                                @if(!\Auth::user()->is_admin)
                                    <input type="hidden" value="{{ $ticket->user->id }}" name="user_id">
                                @endif
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
