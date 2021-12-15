<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\City;
use App\Models\User;
use Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        $contact = new Contact();
        $cities = City::all();
        return view('contact.contact_create', compact('contact', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = null;
        if (Auth::check()) {
            $id = Auth::user()->id;
        } else {
            $id = $request->uid;
        }

        // dd($id);
        //  $redirect=null;
        $request->validate([
            'city_id' => 'required|not_in:0',
            'fulladdress' => 'required',
        ]);

        Contact::create([
            'full_address' => $request->fulladdress,
            'user_id' => $id,
            'city_id' => $request->city_id
        ]);



        // dd(session()->get('url.intended')); 

        if (session()->has('url.intended')) {
            $redirectTo = session()->get('url.intended');

            $prevroute = app('router')->getRoutes($redirectTo)->match(app('request')->create($redirectTo))->getName();
            session()->forget('url.intended');
        }

        if ($prevroute == "user.order.create") {
            return redirect($redirectTo);
        } else if ($prevroute == "admin.order.create") {
            return redirect($redirectTo);
        } else {
            return redirect('user/address/list');
        }



        /* if ($redirectTo) {
            return redirect($redirectTo);
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        $contact = Contact::find($id);
        $cities = City::all();
        return view('contact.contact_create', compact('contact', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->full_address = $request->fulladdress;
        $contact->city_id = $request->city_id;
        $contact->save();


        if (session()->has('url.intended')) {
            $redirectTo = session()->get('url.intended');

            $prevroute = app('router')->getRoutes($redirectTo)->match(app('request')->create($redirectTo))->getName();
            session()->forget('url.intended');
        }

        if ($prevroute == "user.order.create") {
            return redirect($redirectTo);
        } else {
            return redirect('user/address/list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return back();
    }

    function addressCreateByUid($id)
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        $contact = new Contact();
        $user = User::find($id);
        $cities = City::all();
        return view('admin.address.create', compact('contact', 'user', 'cities'));
    }
}
