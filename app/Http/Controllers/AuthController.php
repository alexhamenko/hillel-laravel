<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Enums\UserRoleNameEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display login page.
     *
     * @return View
     */
    public function login(): View
    {
        $urlGithub = 'https://github.com/login/oauth/authorize';
        $parameters = [
            'client_id' => getenv('OAUTH_GITHUB_CLIENT_ID'),
            'redirect_uri' => getenv('OAUTH_GITHUB_REDIRECT_URI'),
            'scope' => 'user',
        ];
        $urlGithub .= '?' . http_build_query($parameters);

        $urlTwitch = 'https://id.twitch.tv/oauth2/authorize';
        $parameters = [
            'client_id' => getenv('OAUTH_TWITCH_CLIENT_ID'),
            'redirect_uri' => getenv('OAUTH_TWITCH_REDIRECT_URI'),
            'response_type' => 'code',
            'scope' => 'user:read:email',
        ];
        $urlTwitch .= '?' . http_build_query($parameters);

        return view('auth/form', compact('urlGithub', 'urlTwitch'));
    }

    /**
     * Handle login request
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function handleLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($credentials['password']);
                $user->save();
            }
            if ($user->can('access-admin-panel')) {
                return redirect()->route('admin.panel');
            } else if ($user->can('access-paid-functionality')) {
                return redirect()->route('paid.functionality');
            }
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle logout request
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    }
}
