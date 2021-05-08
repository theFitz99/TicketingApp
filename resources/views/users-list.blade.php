<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($users->isNotEmpty())
                    @foreach($users as $cnt=>$user)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h4><span class="text-muted">Contact ({{ ++$cnt }}): </span><a href="{{route('user.details', $user->id)}}">{{ $user->name }}</a> ({{ $user->email }})</h4>
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
