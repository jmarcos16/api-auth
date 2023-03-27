<?php

namespace App\Actions;

use App\Models\User;

class DeleteUser extends Actionable
{
  public function handle(int $id = null)
  {
    return User::findOrFail($id)->delete();
  }
}
