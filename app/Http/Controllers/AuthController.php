<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
 
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/home'); // Redirige al dashboard o a la página deseada
        }
 
        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ]);
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect('/home'); // Redirige al login tras el logout
    }
}