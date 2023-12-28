<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function view;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        /*
        $data = $request->all();
        $data = $request->only('name', 'email');
        $data = $request->except('name', 'email');

        $name = $request->input('name');
        $email = $request->input('email');
        $agreement = $request->boolean('agreement');

        if(true)
        {
            return redirect()->back()->withInput();
        }

        return redirect()->route('user');
        */


        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
            'agreement' => ['accepted'],
        ]);

        #First method to create:

        /*
        $user = new User;

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->save();
        */

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        dd($user->toArray());


    }

}
