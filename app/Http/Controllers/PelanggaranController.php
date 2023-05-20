<?php

namespace App\Http\Controllers;

use App\API\ApiFormatter;
use Illuminate\Http\Request;
use DB;
use App\Models\KetPelanggaran;
use App\Models\guru;
use App\Models\Pelanggaran;
use App\Models\PelanggaranAPImodel;
use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;

class PelanggaranController extends Controller
{
    public function pelanggaran(Request $request)
    {
        $keyword=$request->keyword;
        $data = Pelanggaran::where('id_kategori_pelanggaran','LIKE','%'.$request->search.'%')->Paginate(5);
        return view('halaman.pelanggaran', compact('data'));
    }

    public function ketpelanggaran(Request $request)
    {
        $search=$request->search;
        $ket = DB::table('tb_kategori_pelanggaran')->where('kategori_pelanggaran','LIKE','%'.$request->search.'%')->Paginate(5);
        return view('halaman.ketpelanggaran', ['ketpelanggaran' => $ket],['search'=>$search]);
    }
    public function tambahketplg()
    {
        return view('tambah.tambah_ketplg');
    }
    public function store(Request $request)
    {

        DB::table('tb_kategori_pelanggaran')->insert([
            'kategori_pelanggaran' => $request->kategori_pelanggaran,
            'deskripsi_pelanggaran' => $request->deskripsi_pelanggaran,
            'point' => $request->point,



        ]);


        return redirect('/ketpelanggaran')->with('toast_success', 'Data Berhasil Ditambahkan');
    }

    public function destroy($id_kategori_pelanggaran) ///DELETE
    {
        $ket = KetPelanggaran::find($id_kategori_pelanggaran);
        $ket->delete();
        return redirect('/ketpelanggaran')->with('toast_success', 'Data Berhasil Dihapus');;
    }
    public function edit($id_kategori_pelanggaran)  ///EDIT
    {
        $ket = KetPelanggaran::find($id_kategori_pelanggaran);
        return view('edit.edit_ketpelanggaran', compact(['ket']));
    }

    public function update(Request $request, $id_kategori_pelanggaran)
    {
        DB::table('tb_kategori_pelanggaran')->where('id_kategori_pelanggaran', $request->id_kategori_pelanggaran)->update([
            'kategori_pelanggaran' => $request->kategori_pelanggaran,
            'deskripsi_pelanggaran' => $request->deskripsi_pelanggaran,
            'point' => $request->point,
        ]);
        return redirect('/ketpelanggaran')->with('toast_success', 'Data Berhasil Diupdate');
    }


    //PELANGGARAN


    public function tambahplg()
    {
        $siswa = DB::table('tb_siswa')->get();
        $pelanggaran = DB::table('tb_kategori_pelanggaran')->get();
        $guru = User::where('level', 'guru')->get();
        return view('tambah.tambah_plg', compact('siswa', 'pelanggaran', 'guru'));
    }
    public function storeplg(Request $request)
    {
        $data = $request->validate([
            'id_kategori_pelanggaran' => 'required',
            'id_siswa' => 'required',
            'id' => 'required',
            'point' => 'required|numeric',
            'catatan' => 'required',
            'waktu' => 'required'
        ]);
        // dd($data);
        Pelanggaran::create($data);
        // DB::table('tb_pelanggaran')->insert([
        //     'id_kategori_pelanggaran' => $request->id_kategori_pelanggaran,
        //     'id_siswa'=>$request->id_siswa,
        //     'id'=>$request->id,
        //     'point' => $request->point,
        //     'catatan'=>$request->catatan,
        // ]);
        return redirect('/pelanggaran');
    }
    public function editplg($id_pelanggaran)  ///EDIT
    {
        $siswa = DB::table('tb_siswa')->get();
        $pelanggaran = DB::table('tb_kategori_pelanggaran')->get();
        $guru = User::where('level', 'guru')->get();
        return view('edit.edit_pelanggaran', compact('id_pelanggaran','siswa', 'pelanggaran', 'guru'));
        // $pelanggaran = KetPelanggaran::find($id_pelanggaran);
        // return view('edit.edit_pelanggaran', compact(['pelanggaran']));
    }

    public function updateplg(Request $request, $id_pelanggaran)
    {
        
        $data = $request->validate([
            'id_kategori_pelanggaran' => 'required',
            'id_siswa' => 'required',
            'id' => 'required',
            'point' => 'required',
            'catatan' => 'required',
            'waktu' => 'required'
            
        ]);
        $pelanggaran = Pelanggaran::where('id_pelanggaran', $id_pelanggaran)->first();
        $pelanggaran->update($data);
        return redirect('/pelanggaran')->with('toast_success', 'Data Berhasil Diupdate');
    }

    public function destroy1($id_pelanggaran) ///DELETE
    {
        $ket1 = Pelanggaran::find($id_pelanggaran);
        $ket1->delete();
        return redirect('/pelanggaran')->with('toast_success', 'Data Berhasil Dihapus');;
    }


    public function PelanggaranAPI()
    {
        // $pelanggaran=pelanggaran::all();
        // return response()->json($pelanggaran);
      // username
      // password
      // cek di db 
      // kalo username sapa passwordnya benar nampiling smua datanya
      $data = PelanggaranAPImodel::where('id_pelanggaran');
        if($data){
            return ApiFormatter::createApi(200, 'Succes',$data);
        }else{
            return ApiFormatter::createApi(400, 'Gagal');
        }   
     }

}
