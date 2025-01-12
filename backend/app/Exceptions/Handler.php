<?php

namespace App\Exceptions;

use App\Helpers\ApiResponseHelper;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {

            if ($request->is('api/*')) {
                return ApiResponseHelper::error('API resource not found.',  HttpResponse::HTTP_NOT_FOUND);
            }
        }
        if ($exception instanceof ValidationException) {
            if ($request->is('api/*')) {
                return ApiResponseHelper::error('Validation failed.',  HttpResponse::HTTP_UNPROCESSABLE_ENTITY, $exception->errors());
            }
        }
        if ($exception instanceof ModelNotFoundException) {
            if ($request->is('api/*')) {
                return ApiResponseHelper::error('Record not found.',  HttpResponse::HTTP_NOT_FOUND);
            }
        }

        if ($exception instanceof Exception) {
            if ($request->is('api/*')) {
                Log::info("message");
                return ApiResponseHelper::error('An unexpected error occurred.',  HttpResponse::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
            }
        }
        return parent::render($request, $exception);
    }
}
