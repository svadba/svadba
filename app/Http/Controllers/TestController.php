<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;

class TestController extends Controller
{
    public function test_method(){
        return Storage::allDirectories('upload/adverts');
        
    }
}
