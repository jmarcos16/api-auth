<?php

namespace App\Http\Controllers;

use App\Actions\CreateAccessToken;
use Illuminate\Http\Request;

class AuthController extends Controller
{

  public function createToken(Request $request)
  {

    try {

      $auth = CreateAccessToken::run($request);

      return $this->success($auth, 'successfully logged in.');
    } catch (\Throwable $th) {
      return $this->error('Login error.', $th->getMessage(), 401);
    }
  }
}
