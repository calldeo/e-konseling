<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    public function penghargaan(){
        return view('halaman.penghargaan');
    }
}
