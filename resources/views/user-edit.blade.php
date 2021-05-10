<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('user.details', $user->id)}}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ $user->name }}">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ $user->email }}">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-warning" href="{{ route('user.edit.password', $user->id) }}">Edit password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
