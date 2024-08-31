<?php

namespace Radenparhanudin\WsAuth\Exceptions;

use Illuminate\Validation\ValidationException as BaseValidationException;
use Radenparhanudin\WsAuth\Facades\ResponseJson;

class ValidationException extends BaseValidationException
{
    public function render($request)
    {
        return ResponseJson::error(
            message: $this->errors(),
            code: 422
        );
    }
}
