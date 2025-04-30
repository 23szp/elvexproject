<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
<<<<<<< HEAD
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
=======
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'name' => 'required|string|max:255|unique:users',
=======
            'name' => 'required|string|max:255',
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
<<<<<<< HEAD
            'email_verification_token' => Str::random(60),
            'email_verified_at' => null,
        ]);

        $this->sendVerificationEmail($user);

        return redirect()->route('login')
            ->with('success', 'Sikeres regisztráció! Kérjük, erősítsd meg az email címedet a küldött linkre kattintva.');
    }

    private function sendVerificationEmail($user)
    {
        $verificationUrl = route('verify.email', ['token' => $user->email_verification_token]);
        
        Mail::send('emails.verify-email', ['user' => $user, 'verificationUrl' => $verificationUrl], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Email cím megerősítése - ElveX');
        });
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Érvénytelen megerősítő link!');
        }
        
        $user->email_verified_at = Carbon::now();
        $user->email_verification_token = null;
        $user->save();
        
        Auth::login($user);
        
        return redirect()->route('home')
            ->with('success', 'Email cím sikeresen megerősítve!');
=======
        ]);

        Auth::login($user);

        return redirect()->route('home');
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

<<<<<<< HEAD
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->email_verified_at === null) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Az email címed még nincs megerősítve. Kérjük, ellenőrizd a postaládádat vagy kérj új megerősítő emailt.',
                ])->withInput($request->only('email', 'remember'));
            }
            
            return redirect()->intended('/')->with('success', 'Sikeres bejelentkezés!');
=======
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
        }

        return back()->withErrors([
            'email' => 'A megadott adatok nem megfelelőek.',
<<<<<<< HEAD
        ])->withInput($request->only('email', 'remember'));
=======
        ]);
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
    }

    public function logout()
    {
        Auth::logout();
<<<<<<< HEAD

        return redirect('/')->with('success', 'Sikeres kijelentkezés!');
    }
    
    public function showResendForm()
    {
        return view('auth.resend-verification');
    }
    
    public function resendVerificationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if ($user->email_verified_at !== null) {
            return back()->with('info', 'Az email címed már meg van erősítve.');
        }
        
        if (!$user->email_verification_token) {
            $user->email_verification_token = Str::random(60);
            $user->save();
        }
        
        $this->sendVerificationEmail($user);
        
        return back()->with('success', 'Az email megerősítő link újra elküldve.');
    }

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Nem található felhasználó ezzel az email címmel.',
        ]);

        $email = $request->email;


        $lastReset = DB::table('password_resets')
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastReset && Carbon::parse($lastReset->created_at)->diffInMinutes(Carbon::now()) < 60) {
            return back()->with('error', 'Csak óránként egyszer kérhetsz jelszó-visszaállító linket.');
        }

       
        DB::table('password_resets')->where('email', $email)->delete();

       
        $token = Str::random(60);

      
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);


        $user = User::where('email', $email)->first();
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $email]);

        Mail::send('emails.reset-password', ['user' => $user, 'resetUrl' => $resetUrl], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Jelszó visszaállítása - ElveX');
        });

        return back()->with('success', 'A jelszó-visszaállító linket elküldtük az email címedre!');
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return back()->with('error', 'Érvénytelen token!');
        }

        $tokenCreatedAt = Carbon::parse($passwordReset->created_at);
        if (Carbon::now()->diffInMinutes($tokenCreatedAt) > 60) {
            return back()->with('error', 'A token lejárt! Kérj új jelszó-visszaállító linket.');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        $request->session()->flash('success', 'A jelszavad sikeresen megváltozott! Most már bejelentkezhetsz az új jelszavaddal.');
        
        return redirect('/login');
    }

    public function resendVerificationEmailDirect($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Nem található felhasználó ezzel az email címmel.');
        }

        if ($user->email_verified_at !== null) {
            return redirect()->route('login')->with('info', 'Az email címed már meg van erősítve.');
        }

        if (!$user->email_verification_token) {
            $user->email_verification_token = Str::random(60);
            $user->save();
        }

        $this->sendVerificationEmail($user);

        return redirect()->route('login')->with('success', 'Az email megerősítő link újra elküldve.');
    }
}
=======
        return redirect('/');
    }
}
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
