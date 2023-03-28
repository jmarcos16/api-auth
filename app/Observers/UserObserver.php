<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Permission;
use App\Actions\givePermission;

class UserObserver
{
  /**
   * Handle events after all transactions are committed.
   *
   * @var bool
   */
  public $afterCommit = true;
  /**
   * Handle the User "created" event.
   */
  public function created(User $user): void
  {
    //Permission default user
    $permissionDefault = givePermission::run('default', $user->id);


    $permissionAdmin = givePermission::run('admin', 1);
  }
}
