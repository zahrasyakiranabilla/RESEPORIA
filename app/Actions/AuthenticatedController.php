<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\LogoutViewResponse;
use Laravel\Fortify\Contracts\ViewResponse;

class AuthenticatedSessionController extends Controller
{
    public function create(): ViewResponse
    {
        return app(ViewResponse::class);
    }

    public function store(Request $request): LoginResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return app(LoginResponse::class);
    }

    public function destroy(Request $request): LogoutResponse|LogoutViewResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }
}
