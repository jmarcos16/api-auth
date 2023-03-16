<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{

  /**
   * Build UserModel when loading a class
   *
   * @param User $user
   */
  public function __construct(protected User $user)
  {
    $this->user = new User;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    $user = User::all();
    return $this->sendResponse($user, 'All Users successfully selected.');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'confim_password' => 'required|same:password'
    ]);

    if ($validator->fails()) {
      return $this->sendError('Credentials error.', $validator->errors(), 422);
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] = $user->createToken('access_token')->plainTextToken;
    $success['name'] = $user->name;

    return $this->sendResponse($success, 'User register successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {

    try {
      $user = $this->user->findOrFail($id);
      return $this->sendResponse($user, 'User found.');
    } catch (\Exception $th) {
      return $this->sendError('User not found', $th->getMessage(), 404);
    }
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {

    try {
      $user = $this->user->findOrFail($id);

      $input =  $request->all();

      if ($input['password']) {
        $input['password'] = bcrypt($request->password);
      }

      $user->update($input);
      return $this->sendResponse($user, 'User updated successfully.');
    } catch (\Exception $th) {
      return $this->sendError('Failed to update user. ', $th->getMessage(), 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $user = $this->user->findOrFail($id);
      $user->destroy($id);
      return $this->sendResponse($user, 'User deleted successfully.');
    } catch (\Exception $th) {
      return $this->sendError('Failed to deleted user. ', $th->getMessage(), 404);
    }
  }
}
