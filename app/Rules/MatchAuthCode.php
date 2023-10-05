<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class MatchAuthCode implements Rule
{
    protected $authcode;

    public function __construct( $authcode)
    {
        $this->authcode=$authcode;
    }

    public function passes($attribute, $value)
    {
      return $value== $this->authcode;
    }
    public function message()
    {
      return ':attribute が一致しません';
    }
}
