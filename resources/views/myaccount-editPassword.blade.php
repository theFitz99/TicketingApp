<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Password') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('my.account') }}/{{ $user->id }}/edit" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputOldPassword">Old password</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="inputOldPassword" value="{{ old('old_password') }}" name="old_password" placeholder="Old password">
                                <p class="text-danger">{{ $errors->first('old_password') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputNewPassword">New password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="inputNewPassword" value="{{ old('new_password') }}" name="new_password" placeholder="New password">
                                <p class="text-danger">{{ $errors->first('new_password') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputNewPasswordAgain">New password again</label>
                                <input type="password" class="form-control @error('newpassword_again') is-invalid @enderror" id="inputNewPasswordAgain" name="newpassword_again" placeholder="New password again">
                                <p class="text-danger">{{ $errors->first('newpassword_again') }}</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
