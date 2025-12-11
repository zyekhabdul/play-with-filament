<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Handle an incoming password reset link request using email or username.
     */
    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
        ]);

        $login = (string) $request->input('login');

        // Find user by email or username
        $user = User::where('email', $login)
            ->orWhere('username', $login)
            ->first();

        if ($user) {
            $status = Password::sendResetLink(['email' => $user->email]);
        } else {
            // Do not reveal whether the user exists. Pretend success.
            $status = Password::RESET_LINK_SENT;
        }

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}