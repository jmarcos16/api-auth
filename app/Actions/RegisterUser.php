<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class RegisterUser extends Actionable
{

  public function handle(Request $arguments = null)
  {

    $validated  = $arguments->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,users.email',
      'password' => 'required'
    ]);



    $users = User::create([
      'name' => $arguments->name,
      'email' => $arguments->email,
      'password' => bcrypt($arguments->password),
    ]);

    return $users;
  }
}
