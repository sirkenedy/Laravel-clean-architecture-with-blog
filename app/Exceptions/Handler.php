<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
// use Symfony\Component\HttpKernel\Exception\ModelNotFoundException ;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->renderException("Route or resource doesn’t exist", $e->getStatusCode());
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->renderException($e->getMessage(), $e->getStatusCode());
            }
        });

        // $this->renderable(function (ModelNotFoundException $e, $request) {
        //     if ($request->is('api/*')) {
        //         return $this->renderException("Entry for ".str_replace('App\\Models', '', $e->getMessage())." not found", $e->getStatusCode());
        //     }
        // });
    }

    public function renderException($msg, $status)
    {
        return response()->json([
            'success' => false,
            'message' => $msg,
        ], $status);
    }
}
