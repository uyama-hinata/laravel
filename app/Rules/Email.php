<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;


class Email implements Rule
{
  public function passes($attribute, $value)
  {
    return preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $value);
  }
  public function message()
  {
    return ':attribute 正しいメールアドレス形式で入力してください';
  }
}

