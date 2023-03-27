<?php

namespace App\Actions;

use App\Http\Controllers\Controller;

abstract class Actionable extends Controller
{

  public abstract function handle();


  /**
   * @see static::handle()
   */
  public static function run(...$arguments)
  {
    return app(static::class)->handle(...$arguments);
  }
}
