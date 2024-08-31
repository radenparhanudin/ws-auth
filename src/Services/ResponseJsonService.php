<?php

namespace Radenparhanudin\WsAuth\Services;

use Illuminate\Http\Response;

class ResponseJsonService
{
    public function success(
        string $message = null,
        mixed $data = null,
        int $code = Response::HTTP_OK
    ) {
        return response()->json([
            'error' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error(
        mixed $message = null,
        int $code = Response::HTTP_BAD_REQUEST
    ) {
        return response()->json([
            'error' => true,
            'message' => $message,
        ], $code);
    }
}
