<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Person;

class Login_update implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($login)
    {
        $this->login = $login;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = Person::where('login',$value)->first();

        if($user != null && $value != $this->login){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '入力されたユーザー名はすでに使用されています';
    }
}
