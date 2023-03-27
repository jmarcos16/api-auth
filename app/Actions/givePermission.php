<?php

namespace App\Actions;



use App\Models\User;
use App\Models\Permission;
use App\Actions\Actionable;

class givePermission extends Actionable
{

  /**
   * @param string|null $permission
   * @param integer|null $id
   * @return void
   */
  public function handle(string $permission = null, int $id_user = null): void
  {
    $permission =  Permission::where('roles', $permission)->firstOrFail();

    $user = User::findOrFail($id_user);
    $user = $user->permission()->attach($permission);
  }
}
