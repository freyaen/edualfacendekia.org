<?php 

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        // dd(Hash::make('florasan_548#!'), bcrypt('florasan_548#!'));
        return view('dashboard.pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard.login');
    }
}
