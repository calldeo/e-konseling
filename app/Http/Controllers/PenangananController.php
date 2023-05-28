<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use DB;
use Illuminate\Http\Request;
use App\Models\ketpenanganan;
use App\Models\Pelanggaran;
use App\Models\Penanganan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

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
            $request->validate([
                'nama_kategori_penanganan' => ['required', 'min:5', 'max:1000'],
                'catatan'=> ['required', 'min:5', 'max:1000'],
                
                
                // 'password_confirmation' => 'required|same:password',
            ]);
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
        $request->validate([
            'nama_kategori_penanganan' => ['required', 'min:5', 'max:1000'],
            'catatan'=> ['required', 'min:5', 'max:1000'],
            
            
            // 'password_confirmation' => 'required|same:password',
        ]);
       DB::table('tb_kategori_penanganan')->where('id_kategori_penanganan',$request->id_kategori_penanganan)->update([
        'nama_kategori_penanganan' => $request->nama_kategori_penanganan,
                'catatan' => $request->catatan,
       ]);
        return redirect('/ketpenanganan')->with('toast_success', 'Data Berhasil Diupdate');
    }


    public function tambahpng()
    {
       // Mendapatkan ID guru yang sedang login
       $guruId = Auth::id();
    
       // Mendapatkan informasi guru berdasarkan ID
       $guru = Guru::find($guruId);
   
       // Mendapatkan data siswa
       
   
       // Mendapatkan data pelanggaran
       $pelanggaran =Pelanggaran::all();
     
        // $penanganan = DB::table('tb_kategori_penanganan')->get();

        // return view('tambah.tambah_png', compact('siswa', 'pelanggaran', 'guru'));
        return view('tambah.tambah_png', compact('pelanggaran'));
    }
    
    public function storepng(Request $request)
    {
        $guruId = Auth::id();
        $data->validate([
            'id_pelanggaran' => 'required',
            'id_siswa' => 'required',
            'id_kategori_pelanggaran' => 'required',
            'status' => 'required',
            'tindak_lanjut' => 'required',
            'point' => 'required',
            'id_kategori_penanganan' => 'required',
        ]);
        $data['id'] = $guruId;
        Penanganan::create($data);
        // foreach ($pelanggaran as $pelanggaran) {
        //     $penanganan = new Penanganan();
        //     $penanganan->id_pelanggaran = $pelanggaran->id_pelanggaran;
        //     $penanganan->id_siswa = $pelanggaran->id_siswa;
        //     $penanganan->id_kategori_pelanggaran = $pelanggaran->id_kategori_pelanggaran;
        //     $penanganan->point = $pelanggaran->point;
        //     $penanganan->status = $pelanggaran->status;
        //     $penanganan->tindak_lanjut = $pelanggaran->tindak_lanjut;
        //     $penanganan->id_kategori_penanganan = $pelanggaran->id_kategori_penanganan;
    
            // Set field lain yang diperlukan untuk model Penanganan
            // Contoh: $penanganan->siswa_id = $pelanggaran->siswa_id;
            //          $penanganan->keterangan = 'Penanganan default';
    
       
        
    
        return redirect()->back()->with('success', 'Data penanganan berhasil ditambahkan!');
    }
    


}
