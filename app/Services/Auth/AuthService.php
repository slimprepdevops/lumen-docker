<?php 

namespace App\Services\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;

class AuthService
{
	/**
     * Class properties
     *
     * @property
     */
    private $user;

	/**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User;
    }

	/**
	 * Create new login account 
	 * 
	 * @param  array  $data
	 * @return \App\Models\User
	 */
	public function register(array $data)
	{
    	return $this->user->create([
    		'name' => $data['name'],
    		'email' => $data['email'],
    		'password' => app('hash')->make($data['password']),
    	]);
	}

	/**
	 * Authenticate a user
	 * 
	 * @param  array  $data
	 * @return array
	 */
	public function login($data)
	{
		$credentials = [
			'email' => $data['email'], 
			'password' => $data['password'],
		];

        if (! $token = auth()->attempt($credentials)) {
        	return [
        		'status' => 'error', 
        		'code' => 403, 
        		'message' => 'Invalid email or password.'
        	];
        }

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ];
	}

}
