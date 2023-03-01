<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetpenangananController extends Controller
{
    public function ketpenanganan(){
        return view('halaman.ketpenanganan');
    }
}
