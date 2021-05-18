<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->orderBy('name')->get();

        return view('users-list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('user-details', compact('user'));
    }

    public function showContacts(User $user)
    {
        $contacts = $user->contacts()->get();

        return view('user-contacts', compact('contacts', 'user'));
    }

    public function showOpenTickets(User $user)
    {
        $tickets = $user->tickets()->whereNull('is_done')->get();

        return view('user-tickets', compact('user', 'tickets'));
    }

    public function showClosedTickets(User $user)
    {
        $tickets = $user->tickets()->whereNotNull('is_done')->get();

        return view('user-tickets', compact('user', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user)
    {
        return view('user-edit', compact('user'));
    }

    public function editPassword(User $user)
    {
        return view('user-editPassword', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        User::where('id', $user->id)->update($request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]));

        return redirect('/users/'.$user->id)->with('password_updated', 'User information successfully updated!');
    }

    public function updatePassword(Request $request, User $user)
    {
        if (\Auth::user()->is_admin) {
            $request->validate([
                'new_password' => 'min:7|max:13',
                'new_password_again' => 'same:new_password'
            ]);
        } else {
            $request->validate([
                'old_password' => 'password',
                'new_password' => 'min:7|max:13',
                'new_password_again' => 'same:new_password'
            ]);
        }
        User::where('id', $user->id)->update(['password' => Hash::make($request->input('new_password'))]);

        return redirect('/users/'.$user->id)->with('user_updated', 'Password successfully changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

            return redirect('/users')->with('user_deleted', 'User successfully deleted');
    }

    public function search(Request $request)
    {
        $request->validate([
            'userName' => 'required',
        ]);

        $name = $request->input('userName');

        $users = User::where(function ($query) use ($name) {
            $query->where('name', 'LIKE', "%{$name}%");
        })->orderBy('name')->get();

        return view('users-list', compact('users'));
    }

    public function searchContacts(Request $request, User $user)
    {
        $request->validate([
            'searchFirstName' => 'required_without_all:searchLastName',
            'searchLastName' => 'required_without_all:searchFirstName'
        ]);

        $firstName = $request->input('searchFirstName');
        $lastName = $request->input('searchLastName');

        $contacts = $user->contacts()->where(function ($query) use ($firstName, $lastName) {
            $query->where('first_name', 'LIKE', "%{$firstName}%")
                ->where('last_name', 'LIKE', "%{$lastName}%");
        })->orderBy('last_name')->get();

        return view('user-contacts', compact('contacts', 'user'));
    }
}
