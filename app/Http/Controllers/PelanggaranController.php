<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function pelanggaran (){
        return view('halaman.pelanggaran');
    }
}
