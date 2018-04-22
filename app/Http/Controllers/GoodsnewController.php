<?php

namespace App\Http\Controllers;

use App\Goodsnews;
use Illuminate\Http\Request;

class GoodsnewController extends Controller
{
    //
    public function destroy(Goodsnews $goodsnews){
        $goodsnews->delete();
        echo 'success';
    }
}
