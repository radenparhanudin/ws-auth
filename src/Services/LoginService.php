<?php

namespace Radenparhanudin\WsAuth\Services;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Radenparhanudin\WsAuth\Exceptions\ValidationException;

class LoginService
{
    public function ws()
    {
        $ws_login = Http::asForm()
            ->baseUrl(config('ws-auth.apimws_url'))
            ->withBasicAuth(config('ws-auth.consumer_key'), config('ws-auth.consumer_secret'))
            ->post('/oauth2/token', [
                'grant_type' => 'client_credentials',
            ])->object();

        if (isset($ws_login->error)) {
            throw ValidationException::withMessages(['username' => $ws_login->error_description]);
        }

        Cache::put("ws_auth_token", $ws_login->access_token, $ws_login->expires_in);
    }

    public function sso(array $credential)
    {
        $siasn_login = Http::asForm()
            ->baseUrl(config('ws-auth.sso_siasn_url'))
            ->post('/auth/realms/public-siasn/protocol/openid-connect/token', [
                'grant_type' => 'password',
                'username' => $credential['username'],
                'password' => $credential['password'],
                'client_id' => config('ws-auth.client_id'),
            ])->object();

        if (isset($siasn_login->error)) {
            throw ValidationException::withMessages(['username' => $siasn_login->error_description]);
        }

        $user = User::whereUsername($credential['username'])->first();
        if (!$user) {
            $data_utama = Http::baseUrl(config('ws-auth.apimws_url') . ":" . config('ws-auth.apimws_port') . "/apisiasn/1.0")
                ->withToken(Cache::get("ws_auth_token"))
                ->withHeader('Auth', "Bearer $siasn_login->access_token")
                ->get("/pns/data-utama/{$credential['username']}")
                ->object();

            User::create([
                'id' => $data_utama->data->id,
                'name' => $data_utama->data->nama,
                'username' => $data_utama->data->nipBaru,
                'email' => $data_utama->data->email,
                'siasn_access_token' => $siasn_login->access_token,
            ]);
        } else {
            $user->update(['siasn_access_token' => $siasn_login->access_token]);
        }
    }
}
