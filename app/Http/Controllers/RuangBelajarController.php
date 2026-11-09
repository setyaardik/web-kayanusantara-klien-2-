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

        return $request->user()->role === 'guru'
            ? app(GuruController::class)->dashboard($request)
            : app(SiswaController::class)->dashboard($request);
    }
}
