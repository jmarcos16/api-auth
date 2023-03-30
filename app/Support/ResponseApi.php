<?php

namespace App\Support;

trait ResponseApi
{


  public function success($result, string $message)
  {
    $response = [
      'success' => true,
      'data'    => $result,
      'message' => $message,
    ];

    return response()->json($response, 200);
  }

  public function error($error, $errorMessages = [], $code = 500)
  {
    $response = [
      'success' => false,
      'message' => $error,
    ];


    if (!empty($errorMessages)) {
      $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
  }
}
