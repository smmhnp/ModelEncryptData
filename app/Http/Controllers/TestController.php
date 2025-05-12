<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class TestController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required | string | max:255',
            'lastname' => 'required | string | max:255',
            'nickname' => 'required | string | max:255 | unique:users,nickname',
            'email' => 'required | email | max:255 | unique:users,email',
            'password' => 'required | confirmed | min:6',
        ]);

        $firstname = base64_encode(Crypt::encryptString($validated['firstname']));
        $lastname = base64_encode(Crypt::encryptString($validated['lastname']));
        $nickname = base64_encode(Crypt::encryptString($validated['nickname']));
        $email = base64_encode(Crypt::encryptString($validated['email']));

        $user = Test::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
            'email' => $email,
            'password' => Hash::make($validated['password']),
        ]);

        return view('welcome', ['message' => 'Successfully registered!']);
    }


    public function show($id)
    {
        $user = Test::findOrFail($id);

        $firstname = Crypt::decryptString(base64_decode($user->firstname));
        $lastname = Crypt::decryptString(base64_decode($user->lastname));
        $nickname = Crypt::decryptString(base64_decode($user->nickname));
        $email = Crypt::decryptString(base64_decode($user->email));

        return view('show', [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'nickname'  => $nickname,
            'email'     => $email,
        ]);
    }


}
