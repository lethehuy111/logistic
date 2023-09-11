<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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

//    public function render($request, Throwable $e)
//    {
//        if ($e instanceof ValidationException) {
//            return response()->json(new ErrorResource($e->validator->errors(), $e->getCode()), Response::HTTP_BAD_REQUEST);
//        }
//
//        return response()->json(new ErrorResource($e->getMessage(), $e->getCode()), Response::HTTP_BAD_REQUEST);
//    }
}
