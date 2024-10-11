<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function shouldReturnJson($request, Throwable $e)
    {

        // Kiểm tra nếu yêu cầu là từ API (thường được định nghĩa bằng prefix 'api')
        if ($request->is('api/*') || $request->wantsJson() || $request->ajax()) {
            return true; // Trả về JSON cho yêu cầu API hoặc AJAX
        }

        // Nếu không phải API hoặc AJAX, trả về HTML (web)
        return false;
    }
}
