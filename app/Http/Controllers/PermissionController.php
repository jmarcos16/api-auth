<?php

namespace App\Http\Controllers;

use App\Actions\deletePermission;
use App\Actions\givePermission;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends ResponseController
{
  public function store(Request $request, int $user_id)
  {
    try {
      $permission = givePermission::run(permission: $request->permission, id_user: $user_id);

      return $this->success(['permission' => 'successfully'], 'Permission set successfully.');
    } catch (\Throwable $th) {

      return $this->error('Permission not set.', $th->getMessage(), 403);
    }
  }

  public function destroy(Request $request, int $user_id)
  {
    try {

      $permission = deletePermission::run(permission: $request->permission, user_id: $user_id);
      return $this->success(['permission' => 'deleted'], 'Permission deleted successfully.');
    } catch (\Throwable $th) {

      return $this->error('Permission not deleted.', $th->getMessage(), 403);
    }
  }
}
