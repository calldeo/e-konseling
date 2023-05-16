<?php

namespace App\Http\Controllers;

use App\Models\ketriwayat;
use App\Models\Riwayat;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function riwayat(Request $request){
        $keyword=$request->keyword;
        $data = Riwayat::where('id_kategori_riwayat','LIKE','%'.$request->search.'%')->Paginate(5);
        // return view('halaman.pelanggaran', compact('data'));
        return view('halaman.riwayat', compact('data'));
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




    public function tambahrwt()
    {
        $siswa = DB::table('tb_siswa')->get();
        $riwayat = DB::table('tb_kategori_riwayat')->get();
        $guru = User::where('level', 'guru')->get();
        return view('tambah.tambah_riwayat', compact('siswa', 'riwayat', 'guru'));
    }
    public function storerwt(Request $request)
    {
        $data = $request->validate([
            // 'id_riwayat' => 'required',
            'id_siswa' => 'required',
            'id_kategori_riwayat'=>'required',
            'id' => 'required',
            'judul_riwayat' => 'required',
            'catatan_riwayat' => 'required',
            
        ]);
        // dd($data);
        Riwayat::create($data);
        // DB::table('tb_pelanggaran')->insert([
        //     'id_kategori_pelanggaran' => $request->id_kategori_pelanggaran,
        //     'id_siswa'=>$request->id_siswa,
        //     'id'=>$request->id,
        //     'point' => $request->point,
        //     'catatan'=>$request->catatan,
        // ]);
        return redirect('/riwayat');
    }
    public function editrwt($id_riwayat)  ///EDIT
    {
        $siswa = DB::table('tb_siswa')->get();
        $riwayat = DB::table('tb_kategori_riwayat')->get();
        $guru = User::where('level', 'guru')->get();
        return view('edit.edit_riwayat', compact('id_riwayat','siswa', 'riwayat', 'guru'));
        // $pelanggaran = KetPelanggaran::find($id_pelanggaran);
        // return view('edit.edit_pelanggaran', compact(['pelanggaran']));
    }

    public function updateplg(Request $request, $id_riwayat)
    {
        
        $data = $request->validate([
            'id_kategori_riwayat' => 'required',
            'id_siswa' => 'required',
            'id' => 'required',
            'judul_riwayat' => 'required',
            'catatan_riwayat' => 'required',
           
            
        ]);
        $riwayat = Riwayat::where('id_riwayat', $id_riwayat)->first();
        $riwayat->update($data);
        return redirect('/riwayat')->with('toast_success', 'Data Berhasil Diupdate');
    }

    public function destroy1($id_riwayat) ///DELETE
    {
        $ket1 = Riwayat::find($id_riwayat);
        $ket1->delete();
        return redirect('/riwayat')->with('toast_success', 'Data Berhasil Dihapus');
    }
}
