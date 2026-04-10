<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    public function store()
    {
        User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'middle_name' => request('middle_name'),
            'nickname' => request('nickname'),
            'name' => request('first_name') . ' ' . request('last_name'),
            'email' => request('email'),
            'password' => bcrypt('password'),
            'age' => request('age'),
            'address' => request('address'),
            'contact_number' => request('contact_number'),
        ]);

        return redirect('/users');
    }

    public function edit($id)
    {
        return view('users.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'middle_name' => request('middle_name'),
            'nickname' => request('nickname'),
            'email' => request('email'),
            'age' => request('age'),
            'address' => request('address'),
            'contact_number' => request('contact_number'),
        ]);

        return redirect('/users');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/users');
    }
}