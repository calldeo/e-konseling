<?php

namespace App\Http\Controllers;

use App\Models\ketriwayat;
use DB;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function riwayat(){
        return view('halaman.riwayat');
    }


    public function ketriwayat(){
        $ket = DB::table('tb_kategori_riwayat')->get();
        return view('halaman.ketriwayat',['ketriwayat' => $ket]);
    }

    public function tambahketrwt(){
        return view('tambah.tambah_ketrwt');
      }
      public function store(Request $request )
        {   
            
            DB::table('tb_kategori_riwayat')->insert([
                'nama_kategori_riwayat' => $request->nama_kategori_riwayat,
                'catatan' =>$request->catatan,
            ]);
        
            
            return redirect('/ketriwayat')->with('toast_success', 'Data Berhasil Ditambahkan');
        }

        public function destroy($id_kategori_riwayat) ///DELETE
        {
            $ket = ketriwayat::find($id_kategori_riwayat);
            $ket->delete();
            return redirect('/ketriwayat')->with('toast_success', 'Data Berhasil Dihapus');;
        }

        public function edit($id_kategori_riwayat)  ///EDIT
        {
            $ket = ketriwayat::find($id_kategori_riwayat);
            return view('edit.edit_ketriwayat',compact(['ket']));
        }
        
        public function update(Request $request, $id_kategori_riwayat)
    {
       DB::table('tb_kategori_riwayat')->where('id_kategori_riwayat',$request->id_kategori_riwayat)->update([
        'nama_kategori_riwayat' => $request->nama_kategori_riwayat,
                'catatan' => $request->catatan,
       ]);
        return redirect('/ketriwayat')->with('toast_success', 'Data Berhasil Diupdate');;
    }
}
