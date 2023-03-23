<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResponseController extends Controller
{
  public function success(string $message, Collection $data): string
  {
    $response['success'] = true;
    $response['data'] = $data;
    $response['message'] = $message;

    return response()->json($response, 200);
  }

  public function error(string $message, mixed $errors = [], int $code = 500): string
  {
    $response['success'] = false;
    $response['arrors'] = $errors;
    $response['message'] = $message;

    return response()->json($response, $code);
  }
}
