<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Permission;

class deletePermission extends Actionable
{

  /**
   * @param string|null $permission
   * @param integer|null $user_id
   * @return void
   */
  public function handle(string $permission =  null, int $user_id = null): void
  {

    $permission =  Permission::where('roles', $permission)->firstOrFail();
    $user = User::findOrFail($user_id);

    $user = $user->permissions()->detach($permission);
  }
}
