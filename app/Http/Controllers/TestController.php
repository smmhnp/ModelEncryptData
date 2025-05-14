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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'nickname' => 'required|string|max:255|unique:users,nickname',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        Test::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'nickname' => $validated['nickname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return view('welcome', ['message' => 'Successfully registered!']);
    }



    public function show($id)
    {
        $user = Test::findOrFail($id);

        return view('show', [
            'firstname' => $user->firstname,
            'lastname'  => $user->lastname,
            'nickname'  => $user->nickname,
            'email'     => $user->email,
        ]);
    }
    
    
    public function all()
    {
        $users = Test::all();

        foreach ($users as $user){
            
            $data[$user -> id] = [
                'firstname' => $user->firstname,
                'lastname'  => $user->lastname,
                'nickname'  => $user->nickname,
                'email'     => $user->email,
            ];
        }

        return view('all', ['data' => $data]);
    }
}
