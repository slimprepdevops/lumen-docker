<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use App\Validations\Auth\LoginValidation;
use App\Validations\Auth\RegisterValidation;

class AuthController extends Controller
{
    /**
     * Class properties
     * 
     * @property 
     */
    private $authService;
    private $loginValidation;
    private $registerValidation;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        AuthService $authService,
        LoginValidation $loginValidation,
        RegisterValidation $registerValidation
    ) {
        $this->authService = $authService;
        $this->loginValidation = $loginValidation;
        $this->registerValidation = $registerValidation;
    }

    /**
     * Authenticate a user and return a JWT
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $errors = $this->loginValidation->validate($request);
        if ($errors) {
            return $this->errorResponse('Validation error', 422, $errors);
        }

        try {
            $auth = $this->authService->login($request->toArray());

            if (isset($auth['status']) && $auth['status'] === 'error') {
                return $this->errorResponse($auth['message'], $auth['code']);
            }

            return $this->successResponse($auth, 'Authenticated successfully');
        } catch (Exception $e) {
            return $this->error500Response($e, __METHOD__);
        }
    }

    /**
     * Register a user 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $errors = $this->registerValidation->validate($request);
        if ($errors) {
            return $this->errorResponse('Validation error', 422, $errors);
        }

        try {
            $registered = $this->authService->register($request->toArray());

            if (! $registered) {
                return $this->errorResponse('Could not register user');
            }

            return $this->successResponse($registered, 'User registered successfully');
        } catch (Exception $e) {
            return $this->error500Response($e, __METHOD__);
        }
    }

}
