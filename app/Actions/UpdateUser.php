<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;

class UpdateUser extends Actionable
{

  /**
   * @param Request|null $arguments
   * @param integer|null $id
   * @return User
   */

  public function handle(Request $arguments = null,    int $id = null): User
  {

    $validate = $arguments->validate([
      'name' => 'required',
      'email' => 'required',
    ]);

    $user = User::findOrFail($id);

    $user->name = $arguments->name;
    $user->email = $arguments->email;
    isset($arguments->password) ?: $user->password;

    return $user;
  }
}
