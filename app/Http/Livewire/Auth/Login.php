<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user       = collect();
        $usernames  = ['username', 'email', 'phone'];

        foreach ($usernames as $username) {
            if ($user = User::where($username, $request->username)->first()) {
                break;
            }
        }

        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }
    }
}
