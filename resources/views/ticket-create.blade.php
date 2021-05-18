<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('ticket.open.list') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="contact_id">Contact</label>
                                <select class="form-control @error('contact_id') is-invalid @enderror" name="contact_id" id="contact_id">
                                    <option disabled selected>Select contact from here</option>
                                    @foreach(\Auth::user()->contacts()->get() as $contact)
                                    <option value="{{ $contact->id }}" @if(old('contact_id') == $contact->id) selected @endif>{{ $contact->first_name }} {{$contact->last_name}}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('contact_id') }}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="type_id">Ticket type</label>
                                <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                                    <option disabled selected>Select ticket type from here</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}" @if(old('type_id') == $type->id) selected @endif>{{ $type->description }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('type_id') }}</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Ticket title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}" placeholder="Title">
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Ticket description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{old('description')}}" placeholder="Description" rows="4" style="resize: none">{{old('description')}}</textarea>
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                <input type="hidden" value="{{ \Auth::id() }}" name="user_id">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
