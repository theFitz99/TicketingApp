<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('contact.details', $contacts->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputFirstName">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="inputFirstName" name="first_name" value="{{ $contacts->first_name }}">
                                <p class="text-danger">{{ $errors->first('first_name') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputLastName">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="inputLastName" name="last_name" value="{{ $contacts->last_name }}">
                                <p class="text-danger">{{ $errors->first('last_name') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ $contacts->email }}">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPhone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" name="phone"  value="{{ $contacts->phone }}">
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputIban">IBAN</label>
                                <input type="text" class="form-control @error('iban') is-invalid @enderror" id="inputIban" name="iban" value="{{ $contacts->iban }}">
                                <p class="text-danger">{{ $errors->first('iban') }}</p>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address" value="{{ $contacts->address }}">
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="inputCity" name="city"  value="{{ $contacts->city }}">
                                <p class="text-danger">{{ $errors->first('city') }}</p>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputPostCode">Post code</label>
                                <input type="text" class="form-control @error('post_code') is-invalid @enderror" id="inputPostCode" name="post_code"  value="{{ $contacts->post_code }}">
                                <p class="text-danger">{{ $errors->first('post_code') }}</p>
                                <input type="hidden" value="{{ $contacts->user_id }}" name="user_id">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
