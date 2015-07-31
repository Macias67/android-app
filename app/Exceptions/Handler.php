<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($request->wantsJson()) {
            $response = [
                'error' => ucfirst($e->getMessage()),
                'file' => pathinfo($e->getFile(), PATHINFO_BASENAME),
                'line' => $e->getLine(),
                'exception' => pathinfo(get_class($e), PATHINFO_BASENAME)
            ];

            if(config('app.debug')){
                $response['file'] =$e->getFile();
                $response['exception'] = get_class($e);
            }

            $status = 500;

            // If this exception is an instance of HttpException
            if ($this->isHttpException($e)) {
                // Grab the HTTP status code from the Exception
                $status = $e->getStatusCode();
            }

            return response()->json($response, $status);
        }

        return parent::render($request, $e);
    }
}
