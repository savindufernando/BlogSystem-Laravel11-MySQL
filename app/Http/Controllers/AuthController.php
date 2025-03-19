<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends Controller
{
    //Reg
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $token = sha1(time()); 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => $token,
        ]);


        $this->sendVerificationEmail($user);

        return redirect()->route('register')->with('success', 'Registration successful! Please check your email to verify.');
    }



    //Show Login
    private function sendVerificationEmail($user)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
            $mail->Port = env('MAIL_PORT', 587);

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($user->email, $user->name);

            $mail->isHTML(true);
            $mail->Subject = 'Verify Your Email';
            $mail->Body = "
                <h2>Hello, {$user->name}</h2>
                <p>Click the link below to verify your email:</p>
                <a href='" . route('verify.email', ['token' => $user->email_verification_token]) . "'>Verify Email</a>
            ";

            $mail->send();
        } catch (Exception $e) {
            return back()->withErrors(['email' => 'Email could not be sent. Error: ' . $mail->ErrorInfo]);
        }
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);

        return redirect()->route('login')->with('message', 'Email verified successfully! You can now log in.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required|string', 
            'remember' => 'nullable|boolean', 
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->route('auth.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect. Please try again.',
        ])->onlyInput('email'); 
    }


    public function dashboard()
    {
        $user = Auth::user();
        return view('auth.dashboard', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('message', 'You have been logged out.');
    }
}
