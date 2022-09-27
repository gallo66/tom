<?php

namespace App\Http\Composers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use App\Models\Content;
use Illuminate\Http\Request;


class Ka2Composer 
{

    public function compose(View $view){    
        

        $data = Content::all();

        $view->with('data',$data);
    }

}
