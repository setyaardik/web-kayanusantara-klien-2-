<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuangBelajarController extends Controller
{
    public function index(Request $request)
    {
        if (! $request->user()) {
            return view('ruang-gate');
        }

        $user = $request->user();

        return $user->role === 'guru'
            ? view('guru')
            : view('ruang-belajar');
    }
}
