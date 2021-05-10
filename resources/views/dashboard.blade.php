<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($contacts->isNotEmpty())
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if(session()->has('contact_deleted'))
                            <div class="alert alert-success">
                                {{ session()->get('contact_deleted') }}
                            </div>
                        @endif
                        @if(session()->has('contact_created'))
                            <div class="alert alert-success">
                                {{ session()->get('contact_created') }}
                            </div>
                        @endif
                        <form action="{{ route('search.contacts') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="searchFirstName">First name</label>
                                    <input type="text" name="searchFirstName" id="searchFirstName" class="form-control @error('searchFirstName') is-invalid @enderror" placeholder="Contact's first name">
                                    <small class="text-danger">{{ $errors->first('searchFirstName') }}</small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="searchLastName">Last name</label>
                                    <input type="text" name="searchLastName" id="searchLastName" class="form-control @error('searchLastName') is-invalid @enderror" placeholder="Contact's last name">
                                    <small class="text-danger">{{ $errors->first('searchLastName') }}</small>
                                </div>
                            </div>
                            <input type="submit" value="Search" class="btn btn-primary" name="searchBtn" id="searchBtn">
                        </form>
                    </div>
                    @foreach($contacts as $cnt=>$contact)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h4><span class="text-muted">Contact ({{ ++$cnt }}): </span><a href="{{ route('contact.details', $contact->id) }}">{{ $contact->first_name }} {{ $contact->last_name }}</a> ({{ $contact->email }})</h4>
                        </div>
                    @endforeach
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h4>There is no contacts!</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
