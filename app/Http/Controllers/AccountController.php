<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Show the account profile page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('account.profile', compact('user')); // Pass the user data to the view
    }

    /**
     * Show the account edit form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('account.edit', compact('user')); // Pass user data to the edit form view
    }

    /**
     * Update the account information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Get the authenticated user and update their info
        $user = Auth::user();
        $user->update($validated);

        return redirect()->route('account.show')->with('success', 'Profile updated successfully!');
    }
}
