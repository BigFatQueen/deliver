<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // $request->validate([
            
        //     'ps' => [ Rules\Password::defaults()],
        // ]);

        //  dd($request);

        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>$request->phone,
            'password' => Hash::make($request->ps),
        ]);

        $user->assignRole('customer');
        $user->getPermissionsViaRoles();

        event(new Registered($user));

        Auth::login($user);

        return response()->json(['status'=>200]);
        
        return redirect(RouteServiceProvider::HOME);
    }
}
