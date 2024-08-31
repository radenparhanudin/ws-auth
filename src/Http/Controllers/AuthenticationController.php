<?php

namespace Radenparhanudin\WsAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Radenparhanudin\WsAuth\Facades\Login;
use Radenparhanudin\WsAuth\Facades\ResponseJson;
use Radenparhanudin\WsAuth\Http\Requests\LoginRequest;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request) //: JsonResponse
    {
        $credential = $request->only(['username', 'password']);
        // Login::ws();
        Login::sso($credential);
        return ResponseJson::success();
    }
    public function logout(): JsonResponse
    {
        return ResponseJson::success();
    }
}
