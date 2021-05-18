<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\False_;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::guest()) {
            return view('welcome');
        } else if (\Auth::user()->is_admin) {
            $contacts = Contacts::query()->orderBy('last_name')->get();
        } else {
            $contacts = User::query()->find(\Auth::id())->contacts()->get();
        }

        return view('dashboard', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contacts::query()->create($this->validateContact($request));

        return redirect('/contacts')->with('contact_created', 'Contact successfully created!');;;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contacts $contacts)
    {
        return view('contacts-details', compact('contacts'));
    }

    public function showOpenTickets(Contacts $contacts)
    {
        $tickets = $contacts->tickets()->whereNull('is_done')->get();

        return view('contacts-tickets', compact('contacts', 'tickets'));
    }

    public function showClosedTickets(Contacts $contacts)
    {
        $tickets = $contacts->tickets()->whereNotNull('is_done')->get();

        return view('contacts-tickets', compact('contacts', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        return view('contacts-edit', compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {
        Contacts::query()->where('id', $contacts->id)->update($this->validateContact($request));

        return redirect('/contacts/' . $contacts->id)->with('contact_updated', 'Contact information successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contacts)
    {
        $contacts->delete();

        return redirect('/contacts')->with('contact_deleted', 'Contact successfully deleted!');;
    }

    public function search(Request $request)
    {
        $request->validate([
            'searchFirstName' => 'required_without_all:searchLastName',
            'searchLastName' => 'required_without_all:searchFirstName'
        ]);

        $firstName = $request->input('searchFirstName');
        $lastName = $request->input('searchLastName');

        if (\Auth::user()->is_admin) {
            $contacts = Contacts::query()->where(function ($query) use ($firstName, $lastName) {
                $query->where('first_name', 'LIKE', "%{$firstName}%")
                    ->where('last_name', 'LIKE', "%{$lastName}%");
            })->orderBy('last_name')->get();
        } else {
            $contacts = Contacts::query()->where('user_id', \Auth::id())->where(function ($query) use ($firstName, $lastName) {
                $query->where('first_name', 'LIKE', "%{$firstName}%")
                    ->where('last_name', 'LIKE', "%{$lastName}%");
            })->orderBy('last_name')->get();
        }

        return view('dashboard', compact('contacts'));
    }

    protected function validateContact(Request $request)
    {
        return $request->validate([
            'first_name' => 'required',
            'user_id' => 'required',
            'iban' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
            'post_code' => 'required'
        ]);
    }
}
