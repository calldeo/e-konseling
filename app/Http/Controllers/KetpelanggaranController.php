<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetpelanggaranController extends Controller
{
    public function ketpelanggaran(){
        return view('halaman.ketpelanggaran');
    }
}
