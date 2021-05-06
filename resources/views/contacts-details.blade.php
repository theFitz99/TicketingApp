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
                    <h4><span class="text-muted">First name: </span>{{ $contacts->first_name }}</h4>
                    <h4><span class="text-muted">Last name: </span>{{ $contacts->last_name }}</h4>
                    <h4><span class="text-muted">Address: </span>{{ $contacts->address }}</h4>
                    <h4><span class="text-muted">City: </span>{{ $contacts->post_code }} {{ $contacts->city }}</h4>
                    <h4><span class="text-muted">Email: </span><a href="mailto:{{ $contacts->email }}">{{ $contacts->email }}</a></h4>
                    <h4><span class="text-muted">Phone: </span><a href="tel:{{ $contacts->phone }}">{{ $contacts->phone }}</a></h4>
                    <br>
                    <form method="POST" action="{{ route('contacts.list') }}/{{ $contacts->id }}">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-warning" href="{{route('contacts.list')}}/{{ $contacts->id }}/edit">Edit contact</a>
                        <input type="submit" onclick="return confirm('Are you sure you want to delete this contact?');" class="btn btn-danger" value="Delete contact">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
