<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $pelanggaran = Pelanggaran::count();

        $siswaPelanggaran = DB::table('tb_pelanggaran')
            ->select('tb_siswa.nama', DB::raw('COUNT(tb_pelanggaran.id_pelanggaran) as total_pelanggaran'))
            ->join('tb_siswa', 'tb_pelanggaran.id_siswa', '=', 'tb_siswa.id_siswa')
            ->groupBy('tb_siswa.nama')
            ->orderByDesc('total_pelanggaran')
            ->limit(10)
            ->get();
            $penghargaan = Penghargaan::count();

            $siswaPenghargaan = DB::table('tb_penghargaan')
                ->select('tb_siswa.nama', DB::raw('COUNT(tb_penghargaan.id_penghargaan) as total_penghargaan'))
                ->join('tb_siswa', 'tb_penghargaan.id_siswa', '=', 'tb_siswa.id_siswa')
                ->groupBy('tb_siswa.nama')
                ->orderByDesc('total_penghargaan')
                ->limit(10)
                ->get();

        return view('home', compact('pelanggaran', 'siswaPelanggaran','penghargaan','siswaPenghargaan'));

       

        
       
    }

}
