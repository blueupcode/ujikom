<?php

namespace App\Http\Controllers;

use App\Models\Member;
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

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        Auth::user()->outlet->member()->create($data);

        return back();
    }
}
