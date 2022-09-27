<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    protected $table = 'recommends';

    protected $guarded = array('id');

    public function content(){
        return $this->belongsTo('App\Models\Content');
    }
}
