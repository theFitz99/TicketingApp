<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session()->has('contact_updated'))
                        <div class="alert alert-success">
                            {{ session()->get('contact_updated') }}
                        </div>
                    @endif
                    <h4><span class="text-muted">First name: </span>{{ $contacts->first_name }}</h4>
                    <h4><span class="text-muted">Last name: </span>{{ $contacts->last_name }}</h4>
                    <h4><span class="text-muted">Bank account number: </span>{{ $contacts->iban }}</h4>
                    <h4><span class="text-muted">Address: </span>{{ $contacts->address }}</h4>
                    <h4><span class="text-muted">City: </span>{{ $contacts->post_code }} {{ $contacts->city }}</h4>
                    <h4><span class="text-muted">Email: </span><a href="mailto:{{ $contacts->email }}">{{ $contacts->email }}</a></h4>
                    <h4><span class="text-muted">Phone: </span><a href="tel:{{ $contacts->phone }}">{{ $contacts->phone }}</a></h4>
                    @if (\Auth::user()->is_admin)
                        <h4><span class="text-muted">User: </span><a href="{{ route('user.details', $contacts->user->id) }}"> {{ $contacts->user->name }}</a></h4>
                    @endif
                    <br>
                    <form method="POST" action="{{ route('contact.details', $contacts->id) }}">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-warning" href="{{ route('contact.edit', $contacts->id) }}">Edit contact</a>
                        <input type="submit" onclick="return confirm('Are you sure you want to delete this contact?');" class="btn btn-danger" value="Delete contact">
                        <a class="btn btn-info" href="{{ route('contact.open.tickets', $contacts->id) }}">Open tickets</a>
                        <a class="btn btn-info" href="{{ route('contact.closed.tickets', $contacts->id) }}">Closed tickets</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
