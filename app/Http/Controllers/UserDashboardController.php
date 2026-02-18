<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{

    public function index()
    {
        $registrations = Auth::user()->registrations()
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('registrations'));
    }

    public function registrations()
    {
        $registrations = Auth::user()->registrations()
            ->with('event', 'payment')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.registrations', compact('registrations'));
    }

    public function showRegistration($code)
    {
        $registration = Registration::where('code', $code)
            ->with('event', 'payment')
            ->firstOrFail();

        // Verificar se a inscrição pertence ao usuário logado
        if ($registration->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para acessar esta inscrição.');
        }

        return view('user.registration-show', compact('registration'));
    }
}
