<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\ketpenanganan;
use App\Models\Penanganan;

class PenangananController extends Controller
{
    public function penanganan(Request $request)
    {
        $keyword=$request->keyword;
        $data = Penanganan::where('id_kategori_penanganan','LIKE','%'.$request->search.'%')->Paginate(5);
        return view('halaman.penanganan', compact('data'));
    }

    public function ketpenanganan(){
        $ket = DB::table('tb_kategori_penanganan')->get();
        return view('halaman.ketpenanganan',['ketpenanganan' => $ket]);
    }

    public function tambahketpng(){
        return view('tambah.tambah_ketpng');
      }
      public function store(Request $request )
        {   
            
            DB::table('tb_kategori_penanganan')->insert([
                'nama_kategori_penanganan' => $request->nama_kategori_penanganan,
                'catatan' =>$request->catatan,
            ]);
        
            
            return redirect('/ketpenanganan')->with('toast_success', 'Data Berhasil Ditambahkan');
        }

     public function destroy($id_kategori_penanganan) ///DELETE
        {
            $ket = ketpenanganan::find($id_kategori_penanganan);
            $ket->delete();
            return redirect('/ketpenanganan')->with('toast_success', 'Data Berhasil Dihapus');
        }

        public function edit($id_kategori_penanganan)  ///EDIT
        {
            $ket = ketpenanganan::find($id_kategori_penanganan);
            return view('edit.edit_ketpenanganan',compact(['ket']));
        }
        
        public function update(Request $request, $id_kategori_penanganan)
    {
       DB::table('tb_kategori_penanganan')->where('id_kategori_penanganan',$request->id_kategori_penanganan)->update([
        'nama_kategori_penanganan' => $request->nama_kategori_penanganan,
                'catatan' => $request->catatan,
       ]);
        return redirect('/ketpenanganan')->with('toast_success', 'Data Berhasil Diupdate');
    }
}
