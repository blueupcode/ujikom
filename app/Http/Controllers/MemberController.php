<?php

namespace App\Http\Controllers;

use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    static private $validationCreateSchema = [
        'nama' => ['required', 'min:3', 'max:100'],
        'tlp' => ['required', 'min:10', 'max:15'],
        'jenis_kelamin' => ['required', 'in:P,L'],
        'alamat' => ['required', 'min:10'],
    ];

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        if (Helpers::checkMemberNameIsExists($data['nama'])) {
            Log::warning('Member name is exists: ' . $data['nama']);

            return back()->withErrors([
                'nama' => 'Nama anggota sudah ada'
            ]);
        } else {
            $member = Auth::user()->outlet->member()->create($data);

            Log::info('Create member: ' . $member->id . ' by user ' . Auth::user()->id);

            return back();
        }
    }
}
