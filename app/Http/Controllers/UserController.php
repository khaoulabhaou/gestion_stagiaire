<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{   
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }


    public function login(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Veuillez entrer votre e-mail.',
            'email.email' => 'Veuillez entrer un e-mail valide.',
            'password.required' => 'Veuillez entrer votre mot de passe.'
        ]);
    
        // Check if the email exists
        $user = \App\Models\User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Cet e-mail n\'existe pas.']);
        }
    
        // Check if the password is correct
        if (!Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            return back()->withErrors(['password' => 'Mot de passe incorrect.']);
        }

        // If 'remember me' is checked, store the email in a cookie for 30 days
        if ($request->has('remember')) {
            cookie('email', $request->email, 43200); // 30 days
        }
        
        // Regenerate session for security
        $request->session()->regenerate();
    
        // Redirect to dashboard or home with success message
        return redirect('dashboard')->with('Success', 'Connexion réussie.');
    }
    

 public function register(Request $request)
    {
        try {
            // Validate the incoming request fields
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
                'name.required' => 'Le nom d\'utilisateur est obligatoire.',
                'name.unique' => 'Le nom a déjà été pris.',
                'name.min' => 'Le nom d\'utilisateur doit comporter au moins 5 caractères.',
                'name.max' => 'Le nom d\'utilisateur ne peut pas dépasser 25 caractères.',
                'email.required' => 'L\'e-mail est obligatoire.',
                'email.email' => 'L\'adresse e-mail doit être une adresse valide.',
                'email.unique' => 'Cet e-mail est déjà enregistré. Veuillez en utiliser un autre.',
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
                'password.max' => 'Le mot de passe ne peut pas dépasser 15 caractères.',
                'password.regex' => 'Le mot de passe doit contenir au moins une lettre, un chiffre et un caractère spécial.',
            ]);

            // Hash the password
            $incomingfields['password'] = bcrypt($incomingfields['password']);
            
            // Create the new user
            $user = User::create($incomingfields);

            // Fire the Registered event to trigger email verification
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Redirect to the email verification page with a success message
            return redirect()->route('verification.notice')->with('success', 'Veuillez vérifier votre adresse e-mail.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database errors, such as when the email already exists
            if ($e->getCode() == 23000) { // Integrity constraint violation (duplicate email)
                return back()->withErrors(['email' => 'Cet e-mail est déjà enregistré. Veuillez en utiliser un autre.']);
            }

            // Catch any other errors and show a generic error message
            return back()->withErrors(['error' => 'Quelque chose s\'est mal passé !']);
        }
    }
}