<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetriwayatController extends Controller
{
    public function ketriwayat(){
        return view('halaman.ketriwayat');
    }
}
