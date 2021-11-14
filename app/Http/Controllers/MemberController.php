<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    static private $validationCreateSchema = [
        'nama' => 'required|min:3|max:100',
        'tlp' => 'required|min:10|max:15',
        'jenis_kelamin' => 'required|in:P,L',
        'alamat' => 'required|min:10',
    ];

    static public function checkMemberNameIsExists($memberName, $existMemberName = null)
    {
        if ($memberName === $existMemberName) {
            return false;
        } else {
            return Auth::user()->outlet->member()->where('nama', $memberName)->exists();
        }
    }

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        if (static::checkMemberNameIsExists($data['nama'])) {
            return back()->withErrors([
                'nama' => 'Nama anggota sudah ada'
            ]);
        } else {
            Auth::user()->outlet->member()->create($data);
            return back();
        }
    }
}
