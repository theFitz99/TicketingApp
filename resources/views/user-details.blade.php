<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <h4><span class="text-muted">Name: </span>{{ $user->name}}</h4>
                    <h4><span class="text-muted">Email: </span><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></h4>
                    <br>
                    @if (\Auth::user()->is_admin)
                        <a class="btn btn-info" href="{{ route('user.details', $user->id) }}/contacts">Contacts</a>
                    @endif
                    <a class="btn btn-warning" href="{{route('user.details', $user->id)}}/edit">Edit user</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
