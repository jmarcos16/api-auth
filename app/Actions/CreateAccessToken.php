<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CreateAccessToken extends Actionable
{

  use ValidatesRequests;

  public function handle(Request $request = null): array
  {

    $validate = $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);


    if ($this->authenticate($validate)) {

      $token = $request->user()->createToken('access_token')->plainTextToken;

      return [
        'name' => $request->user()->name,
        'token' => $token
      ];
    }

    abort(403, 'Unauthorized action.');
  }


  protected function authenticate(array $arguments): bool
  {
    return Auth::attempt(['email' => $arguments['email'], 'password' => $arguments['password']]);
  }
}
