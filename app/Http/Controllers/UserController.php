<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Attempt to log the user in with the provided email and password
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerate session after login
            $request->session()->regenerate();
            // Redirect to the homepage or a dashboard with a success message
            return redirect('/')->with('Success', 'Logged in successfully');
        }
    
        // Return back with an error message if login fails
        return back()->withErrors(['loginError' => 'Invalid username or password']);
    }
    
    
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        try {
            $incomingfields = $request->validate([
                'name' => ['required', 'min:5', 'max:25', Rule::unique('users', 'name')],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => [
                    'required', 
                    'min:8', 
                    'max:15',
                    'regex:/[A-Za-z]/', // At least one letter
                    'regex:/[0-9]/', // At least one number
                    'regex:/[\W_]/', // At least one special character
                ]
            ], [
                'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, un chiffre et un caractère spécial.',
                'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
                'password.max' => 'Le mot de passe ne peut pas dépasser 15 caractères.',
                'name.min' => 'Le nom d\'utilisateur doit comporter au moins 5 caractères.',
                'name.max' => 'Le nom d\'utilisateur ne peut pas dépasser 25 caractères.',
            ]);
    
            $incomingfields['password'] = bcrypt($incomingfields['password']);
            $user = User::create($incomingfields);
    
            Auth::login($user);
    
            return redirect('dashboard')->with('success', 'Registration successful!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                return back()->withErrors(['email' => 'This email is already registered. Please use a different one.']);
            }
    
            return back()->withErrors(['error' => 'Something went wrong!']);
        }
    }
    
    
    
}