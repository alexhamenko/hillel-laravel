<?php

namespace App\Http\Controllers\Oauth;

use App\Models\User;
use App\Enums\UserRoleNameEnum;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class TwitchController
{
    public function __invoke()
    {
        $url = 'https://id.twitch.tv/oauth2/token';
        $parameters = [
            'client_id' => getenv('OAUTH_TWITCH_CLIENT_ID'),
            'client_secret' => getenv('OAUTH_TWITCH_CLIENT_SECRET'),
            'redirect_uri' => getenv('OAUTH_TWITCH_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
            'code' => request()->input('code'),
        ];
        $url .= '?' . http_build_query($parameters);
        $response = Http::post($url);

        if (!$response->ok()) {
            throw new Exception("Error");
        }

        $token_data = json_decode($response->body(), true);

        if (!isset($token_data['access_token'])) {
            return redirect()->route('auth.login');
        }

        $user = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token_data['access_token'],
            'Client-Id' => getenv('OAUTH_TWITCH_CLIENT_ID'),
        ])->get('https://api.twitch.tv/helix/users');


        if (!isset($user['data'][0]) || !$this->createUser($user['data'][0])) {
            return redirect()->route('auth.login');
        }
        return redirect()->route('admin.panel');
    }


    /**
     * @param array $userInfo
     * @return bool
     */
    protected function createUser(array $userInfo): bool
    {
        if (!isset($userInfo['email'])) {
            return false;
        }

        $user = User::where('email', $userInfo['email'])->first();
        if (empty($user)) {
            $user = User::create([
                'name' => $userInfo['display_name'],
                'email' => $userInfo['email'],
                'role_name' => UserRoleNameEnum::Author->value,
                'password' => Hash::make($userInfo['id'] . '_' . $userInfo['login']),
            ]);
        }
        Auth::login($user);

        return true;
    }
}
