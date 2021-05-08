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
        $users = User::all();

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
        $contacts = $user->contacts;

        return view('user-contacts', compact('contacts', 'user'));
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

        return redirect('/users/'.$user->id);
    }

    public function updatePassword(Request $request, User $user)
    {
        if (\Auth::user()->is_admin) {
            $request->validate([
                'new_password' => 'min:7|max:13',
                'newpassword_again' => 'same:new_password'
            ]);
        } else {
            $request->validate([
                'old_password' => 'password',
                'new_password' => 'min:7|max:13',
                'newpassword_again' => 'same:new_password'
            ]);
        }
        User::where('id', $user->id)->update(['password' => Hash::make($request->input('new_password'))]);

        return redirect('/users/'.$user->id)->with('message', 'Password changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
