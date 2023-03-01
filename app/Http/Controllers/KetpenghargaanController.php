<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetpenghargaanController extends Controller
{
    public function ketpenghargaan(){
        return view('halaman.ketpenghargaan');
    }
}
