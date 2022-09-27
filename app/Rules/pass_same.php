<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Person;

class pass_same implements Rule
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
        $user = Person::where('login',$this->login)->first();

        if($user == null){
            return true;
        }else{
            if($user->password == $value){
                return true;
            }else{
                return false;
            }           

        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '入力されたパスワードが違います';
    }
}
