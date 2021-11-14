<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    static private $validationCreateSchema = [
        'nama' => ['required', 'min:3', 'max:100'],
        'username' => ['required', 'min:3', 'max:30'],
        'password' => ['required', 'min:8'],
        'role' => ['required', 'in:admin,kasir,owner']
    ];

    static private $validationUpdateSchema = [
        'nama' => ['required', 'min:3', 'max:100'],
        'username' => ['required', 'min:3', 'max:30'],
        'password' => ['nullable', 'min:8'],
    ];

    static private $validationLoginSchema = [
        'username' => ['required', 'min:3', 'max:30'],
        'password' => ['required', 'min:8'],
    ];

    static public function checkUserNameIsExist($username, $existUsername = null) {
        if ($username === $existUsername) {
            return false;
        } else {
            return User::where('username', $username)->exists();
        }
    }

    public function viewLogin()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $data = $request->validate(self::$validationLoginSchema);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect()->route('report');
        } else {
            return back()->withErrors([
                'credential' => 'Gagal login cek kembali username dan password',
            ]);
        }
    }

    public function handleLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        if (static::checkUserNameIsExist($data['username'])) {
            return back()->withErrors([
                'username' => 'Username sudah ada'
            ]);
        } else {
            $data['password'] = Hash::make($data['password']);
            
            Auth::user()->outlet->user()->create($data);
    
            return back();
        }
    }

    public function handleUpdate(User $user, Request $request)
    {
        $data = $request->validate(self::$validationUpdateSchema);

        if (static::checkUserNameIsExist($data['username'], $user->username)) {
            return back()->withErrors([
                'username' => 'Username sudah ada'
            ]);
        } else {
            if ($data['password'] === null) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }
    
            $user->update($data);
            return back();
        }
    }

    public function handleDelete(User $user)
    {
        $user->delete();

        return back();
    }
}
