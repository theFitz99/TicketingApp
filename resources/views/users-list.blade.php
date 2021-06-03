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
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if(session()->has('user_deleted'))
                            <div class="alert alert-success">
                                {{ session()->get('user_deleted') }}
                            </div>
                        @endif
                        <form action="{{ route('search.user') }}" method="GET" autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="userName">User search</label>
                                    <input type="text" name="userName" id="userName" class="form-control @error('userName') is-invalid @enderror" placeholder="User's name">
                                    <small class="text-danger">{{ $errors->first('userName') }}</small>
                                </div>
                            </div>
                            <input type="submit" value="Search" class="btn btn-primary" name="searchBtn" id="searchBtn">
                        </form>
                    </div>
                    @foreach($users as $cnt=>$user)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h4><span class="text-muted">User ({{ ++$cnt }}): </span><a href="{{route('user.details', $user->id)}}">{{ $user->name }}</a> ({{ $user->email }})</h4>
                        </div>
                    @endforeach
                    @if($users->hasPages())
                        <div class="p-6 bg-white">
                            {{ $users->withQueryString()->links() }}
                        </div>
                    @endif
                @else
                    <div class="p-6 bg-white">
                        <h4>There is no contacts!</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
