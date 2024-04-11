<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\API\BaseController;
use Exception;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'email|required|unique:users',
                'password' => 'required|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            $validatedData = $validator->validated();

            $validatedData['password'] = bcrypt($request->password);

            $user = User::create($validatedData);

            $accessToken = $user->createToken('authToken')->accessToken;

            return $this->sendResponse('User Created Successfully', ['user' => $user, 'access_token' => $accessToken]);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'email|required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            $validatedData = $validator->validated();

            if (!auth()->attempt($validatedData)) {
                return $this->sendResponse('Invalid credentials');
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return $this->sendResponse('User Logged in Successfully', ['user' => auth()->user(), 'access_token' => $accessToken]);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();

            return $this->sendResponse('User Logged out Successfully');
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }
}
