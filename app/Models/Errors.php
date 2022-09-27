<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errors extends Model
{
    public static $errors = array(

        'login.required'=>'ユーザー名が未入力です',
        'mail.required'=>'メールアドレスが未入力です',
        'password.required'=>'パスワードが未入力です',
        'repassword.required'=>'再確認用のパスワードが未入力です',
        'repassword.same'=>'再確認用のパスワードが違います',

    );
}
