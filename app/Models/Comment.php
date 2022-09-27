<?php

namespace App\Models;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Session;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $guarded = array('id');

    public function person(){
        return $this->belongsTo('App\Models\Person');
    }


    public function getUser(){
        
      
        $id = null;

        if(Session::has('user')){

            $person = Session::get('user');
            $id = $person->id;
        }

        return $id;
    }

}


