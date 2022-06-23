<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Format and return error response
     *
     * @param  string  $error
     * @param  int  $code
     * @param  string  $devError
     * @return \Illuminate\Http\Response
     */
    protected function errorResponse($message, $code = 400, $errors = '', $devError = '', $stackTrace = '')
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if ($errors != '' && is_array($errors)) {
            $response['errors'] = $errors;
        } 

        if ($errors != '' && is_string($errors)) {
            if (env('APP_DEBUG') == 'true') {
                $response['dev_error'] = $errors;
            }

            if ($devError != '' && env('APP_DEBUG') == 'true') {
                $response['stack_trace'] = $devError;
            }
        } else {

            if ($devError != '' && env('APP_DEBUG') == 'true') {
                $response['dev_error'] = $devError;
            }

            if ($stackTrace != '' && env('APP_DEBUG') == 'true') {
                $response['stack_trace'] = $stackTrace;
            }

        }

        return response()->json($response, $code);
    }

    /**
     * Format and return response for 500 error specifically
     *
     * @param  \Exception  $e
     * @param  string  $method
     * @return \Illuminate\Http\Response
     */
    protected function error500Response($e, $method = '')
    {
        $method = ($method != '') ? $method : '';

        \Log::error('Error @ ' . $method . ' => ' . $e);

        $line = ' @ (possible line number: ' . $e->getLine() . ')';
        $message = $e->getMessage() . $line;
        $trace = 'Trace from ' . $method . $line;

        return $this->errorResponse('Something went wrong', 500, $message, $trace);
    }

    /**
     * Format and return success response
     *
     * @param  array|string  $data
     * @param  string|int  $message
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    protected function successResponse($data, $message = '', $code = 200)
    {
        if (is_string($data) && is_int($message)) {
            return response()->json([
                'status' => 'success',
                'message' => $data,
            ], $message);
        }

        if (is_string($data) && $message == '') {
            return response()->json([
                'status' => 'success',
                'message' => $data,
            ], $code);
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
