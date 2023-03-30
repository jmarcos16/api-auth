<?php

namespace App\Http\Controllers;

use App\Actions\DeleteUser;
use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\RegisterUser;
use App\Actions\UpdateUser;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = User::all();
    return $this->success($users, 'Selected all users successfully.');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    try {
      $user = RegisterUser::run($request);
      return $this->success($user, 'User created successfully');
    } catch (\Throwable $th) {
      return $this->error($th->getMessage(), $th->getMessage(), 403);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {

    try {
      return User::findOrFail($id);
    } catch (Throwable $th) {
      return $this->error('User not found.', $th->getMessage(), 404);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {


      $user = UpdateUser::run(arguments: $request, id: $id);
      return $this->success($user, 'User updated successfully');
    } catch (\Throwable $th) {
      return $this->error('User not updated.', $th->getMessage(), 403);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {

    try {


      $user = DeleteUser::run($id);
      return $this->success($user, 'User deleted successfully');
    } catch (\Throwable $th) {
      return $this->error('User not deleted.', $th->getMessage(), 403);
    }
  }
}
