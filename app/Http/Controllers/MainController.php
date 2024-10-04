<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        return view('home', ['notes' => $notes]);
    }
    public function newNote()
    {
        echo "dasdadasd ";
    }
    public function editNote($id)
    {
        try {
            $id =  Crypt::decrypt($id);
        } catch (DecryptException $e) {

            return redirect()->route('home');
        }
    }
    public function deleteNote($id)
    {
        try {
            $id =  Crypt::decrypt($id);
        } catch (DecryptException $e) {

            return redirect()->route('home');
        }    }
}
