<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();

        switch ($user->status) {
            case 'officer':
                $message = 'Logged in successfully';
                break;
            case 'manager':
                $message = 'Logged in successfully';
                break;
            case 'finance':
                $message = 'Logged in successfully';
                break;
            default:
                $message = 'Logged in successfully.';
                break;
        }

        session()->flash('toast', [
            'message' => $message,
            'type' => 'success',
            'duration' => 3000,
        ]);

        switch ($user->status) {
            case 'officer':
                return redirect()->intended(route('officer.index'));
            case 'manager':
                return redirect()->intended(route('manager.index'));
            case 'finance':
                return redirect()->intended(route('finance.index'));
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['status' => 'Status not recognized']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
