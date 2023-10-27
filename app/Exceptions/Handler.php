<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
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


    /**
     * Modify exception logging. Log without massive trace messages
     * @param Throwable $exception
     * @return void
     */
    public function report(\Throwable $exception)
    {
        // new compact Exception logging format
        $exceptionFormat = "Class: %s | Message: %s | FILE: %s -> L:%s | URL: %s | IP: %s %s" . PHP_EOL . "%s";
        Log::error(
            sprintf(
                $exceptionFormat,
                get_class($exception),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                request()->fullUrl(),
                request()->ip(),
                session('producerId') ? '| ProducerID: ' . session('producerId') : '',
                '' //config('app.debug') ? $exception->getTraceAsString() : ''
            )
        );
    }
}
