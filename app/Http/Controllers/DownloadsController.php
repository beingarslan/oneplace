<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;

class DownloadsController extends Controller
{
    public function download($file_name) {
        
        $file_path = public_path('letters/'.$file_name);
        return response()->download($file_path);
    }
}
