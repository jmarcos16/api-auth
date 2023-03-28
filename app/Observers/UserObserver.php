<?php

namespace App\Observers;

use App\Actions\givePermission;
use App\Models\User;

class UserObserver
{
  // /**
  //  * Handle events after all transactions are committed.
  //  *
  //  * @var bool
  //  */
  // public $afterCommit = true;
  // /**
  //  * Handle the User "created" event.
  //  */
  // public function created(User $user): void
  // {
  //   //Permission default user
  //   $permissionDefault = givePermission::run('default', $user->id);
  // }
}
