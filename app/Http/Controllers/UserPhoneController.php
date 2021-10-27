<?php

namespace App\Http\Controllers;

use App\Models\UserPhone;
use Illuminate\Http\Request;

class UserPhoneController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'phone' => 'required|regex:/((?:\+?3|0)6)(?:-|\()?(\d{1,2})(?:-|\))?(\d{3})-?(\d{3,4})/',
            'email' => 'required|email|unique:users'
        ]);

        $input = $request->all();
        $userPhone = UserPhone::create($input);

        return back()->with('success', 'User created successfully.');
    }
}
