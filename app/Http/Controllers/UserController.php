<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'type' => 'required|in:Writer,Editor',
            'status' => 'required|in:Active,Inactive',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'type' => $request->type,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit($encryptedId)
    {
        $user = Crypt::decrypt($encryptedId);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $encryptedId)
    {
        $user = Crypt::decrypt($encryptedId);
        
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'type' => 'required|in:Writer,Editor',
            'status' => 'required|in:Active,Inactive',
        ]);

        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'Article updated successfully!');
    }
}
