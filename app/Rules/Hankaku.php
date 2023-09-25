<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hankaku implements Rule
{
    public function passes($attribute, $value)
  {
    return preg_match('/^[a-zA-Z0-9]+$/', $value);
  }
  public function message()
  {
    return ':attribute は半角英数字で入力してください';
  }
}

class Email implements Rule
{
  public function passes($attribute, $value)
  {
    return preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $value);
  }
  public function message()
  {
    return ':attribute は半角英数字で入力してください';
  }
}
