<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Page
    public function admin()
    {
        return view('admin.dashboard');
    }

    // Dashboard Profile Page
    public function profile()
    {
        return view('admin.profile');
    }

    // Dashboard Users Page
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

   // Dashboard product Create Page
 

   // Dashboard product Create Page
 

    public function checkemail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true]);
        }

        return response()->json(['exists' => false]);
    }
}
