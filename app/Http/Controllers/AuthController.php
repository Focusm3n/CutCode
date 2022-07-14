<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ["required", "email", "string"],
            'password' => ['required']
        ]);

        if (auth('web')->attempt($data)){
            return redirect(route('posts.index'));
        }

        return redirect(route('login'))->withErrors(['email' => 'Пользователь не найден, либо данные введены не правильно']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function logout()
    {
        auth("web")->logout();

        return redirect(route("posts.index"));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ["required", "email", "string", "unique:users,email"],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        if($user) {
            auth("web")->login($user);
        }

        return redirect(route('posts.index'));
    }
}
