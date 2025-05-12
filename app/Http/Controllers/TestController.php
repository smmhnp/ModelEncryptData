<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\EncryptUserData;

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

        $firstname = (Crypt::encryptString($validated['firstname']));
        $lastname = (Crypt::encryptString($validated['lastname']));
        $nickname = (Crypt::encryptString($validated['nickname']));
        $email = (Crypt::encryptString($validated['email']));

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

        $firstname = Crypt::decryptString(($user->firstname));
        $lastname = Crypt::decryptString(($user->lastname));
        $nickname = Crypt::decryptString(($user->nickname));
        $email = Crypt::decryptString(($user->email));

        return view('show', [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'nickname'  => $nickname,
            'email'     => $email,
        ]);
    }
    
    
    public function all()
    {
        $users = Test::all();

        foreach ($users as $user){
            $firstname = Crypt::decryptString(base64_decode($user->firstname));
            $lastname = Crypt::decryptString(base64_decode($user->lastname));
            $nickname = Crypt::decryptString(base64_decode($user->nickname));
            $email = Crypt::decryptString(base64_decode($user->email));

            $data[$user -> id] = [
                'firstname' => $firstname,
                'lastname'  => $lastname,
                'nickname'  => $nickname,
                'email'     => $email,
            ];
        }

        return view('all', ['data' => $data]);
    }
}
