<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginSubmit(Request $request)
    {

        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            [
                'text_username.required' => 'O username e obrigatorio',
                'text_username.email' => 'Username deve ser um email valido',
                'text_password.required' => 'O password e obrigatorio',
                'text_password.min' => 'O password deve ter pelo menos :min caracteres',
                'text_password.max' => 'O password deve ter no maximo :max caracteres'
            ]

        );
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('username', $username)->where('deleted_at', NULL)->first();
        if (!$user) {
            return redirect()->back()->withInput()->with("loginError", "Username ou password incorreto.");
        }
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with("loginError", "Username ou password incorreto.");
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);
        echo ('<pre>');
        echo ($user);
    }
    public function logout()
    {
        session()->forget('user');
        return redirect()->to("/login");
    }
}
