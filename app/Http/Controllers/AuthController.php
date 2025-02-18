<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    // Show Registration Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle User Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Auto-login after registration

        return redirect()->route('verification.notice'); // Redirect to email verification notice
    }

    // Show Email Verification Notice
    public function verifyEmailNotice()
    {
        return view('auth.verify-email');
    }

    // Handle Email Verification
    public function verifyEmailHandler(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard')->with('success', 'Votre e-mail a été vérifié avec succès.');
    }

    // Resend Verification Email
    public function verifyEmailResend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }
}
