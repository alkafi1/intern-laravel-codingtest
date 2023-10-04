<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Write your own code 
        // return $id;
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('profile.edit') // Change this to your profile edit route
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's profile
        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        $status = array(
            'type' => 'success',
            'message' => 'Profile updated successfully',
        );
        return redirect()
            ->route('profile.edit') // Change this to your profile index route
            ->with('status',$status);
    }

    /**
     * Update Passowrd the user's account.
     */
    public function update_password(Request $request, $id): RedirectResponse
    {
        // Write your own code 
        // return $id;
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('profile.edit') // Change this to your profile edit route
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's profile
        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()
            ->route('profile.edit') // Change this to your profile index route
            ->with('success', 'Profile updated successfully');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
