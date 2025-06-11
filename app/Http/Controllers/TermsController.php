<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function accept(Request $request) {
        $user = Auth::user();

        $user->update([
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Termos aceitos com sucesso.',
        ]);
    }
}
