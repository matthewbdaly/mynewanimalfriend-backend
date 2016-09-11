<?php

namespace AnimalFriend\Http\Controllers;

use Illuminate\Http\Request;

use AnimalFriend\Http\Requests;
use AnimalFriend\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use AnimalFriend\User;
use Hash;

class AuthenticateController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function authenticate(Request $request)
    {
        // Get credentials
        $credentials = $request->only('email', 'password');

        // Get user
        $user = $this->user->where('email', $credentials['email'])->first();

        // If user is blacklisted, raise 403
        if ($user && $user->blacklisted == 1) {
            return response()->json(['error' => 'user_blacklisted'], 403);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
