<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $dates = ['now_time'];

    protected $guarded = array('id');

    public function content(){
        return $this->belongsTo('App\Models\Content');
    }
    
    public function person(){
        return $this->belongsTo('App\Models\Person');
    }

}
