<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{

    /**
     * Authenticate user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function auth(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 401);
        }



        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::where('email', $request->email)->first();

            $success['token'] = $user->createToken('access_token')->plainTextToken;
            $success['name'] = $user->name;


            return $this->sendResponse($success, 'User login successfully.');
        }

        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
}
