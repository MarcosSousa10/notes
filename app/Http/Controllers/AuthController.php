<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

        $userModel = new User();
        $users = $userModel->all()->toArray();
        echo '<pre>';
        print_r($users);
    }
    public function logout()
    {
        echo "logout";
    }
}
