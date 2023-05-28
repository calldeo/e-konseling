<?php

namespace App\Http\Controllers;

use App\API\ApiFormatter;
use App\Http\Resources\PelanggaranSiswaCollection;
use App\Imports\PelanggaranExport;
use Illuminate\Http\Request;
use DB;
use App\Models\KetPelanggaran;
use App\Models\guru;
use App\Models\Pelanggaran;
use App\Models\PelanggaranAPImodel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Facades\Excel;

class PelanggaranController extends Controller
{

    public function exportPelanggaran()
{
    // return Pelanggaran::with('siswa','ketpelanggaran','user')->get();
    return Excel::download(new PelanggaranExport(), 'pelanggaran.xlsx');
}

    public function pelanggaran(Request $request)
    {
        $search = $request->search;
        $data = Pelanggaran::whereHas('siswa', function ($query) use ($search) {
                $query->where('nama', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10);
        $data->appends(['search' => $search]);
        return view('halaman.pelanggaran', compact('data', 'search'));
    }
    

    public function ketpelanggaran(Request $request)
    {
        $search=$request->search;
        $ket = DB::table('tb_kategori_pelanggaran')->where('kategori_pelanggaran','LIKE','%'.$request->search.'%')->Paginate(10);
        return view('halaman.ketpelanggaran', ['ketpelanggaran' => $ket],['search'=>$search]);
    }
    public function tambahketplg()
    {
        return view('tambah.tambah_ketplg');
    }
    public function store(Request $request)
    { $request->validate([
        'kategori_pelanggaran' => ['required', 'min:5', 'max:30'],
        'deskripsi_pelanggaran'=> ['required', 'min:5', 'max:30'],
        'point' => ['required', 'min:5', 'max:30','number'],
        
        // 'password_confirmation' => 'required|same:password',
    ]);

    // try {
      

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
    {$request->validate([
        'kategori_pelanggaran' => ['required', 'min:5', 'max:30'],
        'deskripsi_pelanggaran'=> ['required', 'min:5', 'max:30'],
        'point' => ['required', 'min:5', 'max:30','number'],
        
        // 'password_confirmation' => 'required|same:password',
    ]);

        DB::table('tb_kategori_pelanggaran')->where('id_kategori_pelanggaran', $request->id_kategori_pelanggaran)->update([
            'kategori_pelanggaran' => $request->kategori_pelanggaran,
            'deskripsi_pelanggaran' => $request->deskripsi_pelanggaran,
            'point' => $request->point,
        ]);
        return redirect('/ketpelanggaran')->with('toast_success', 'Data Berhasil Diupdate');
    }


    //PELANGGARAN


    public function tambahplg(Request $request)
    {
        // Mendapatkan ID guru yang sedang login
        $guruId = Auth::id();
    
        // Mendapatkan informasi guru berdasarkan ID
        $guru = Guru::find($guruId);
    
        // Mendapatkan data siswa
        $siswa = Siswa::all();
    
        // Mendapatkan data pelanggaran
        $pelanggaran = DB::table('tb_kategori_pelanggaran')->get();
    
        // Menampilkan view tambah pelanggaran dengan data siswa, pelanggaran, dan guru
        return view('tambah.tambah_plg', compact('siswa', 'pelanggaran', 'guru'));
    }
    
    public function storeplg(Request $request)
    {
        // Mendapatkan ID guru yang sedang login
        $guruId = Auth::id();
    
        $data = $request->validate([
            'id_kategori_pelanggaran' => 'required',
            'id_siswa' => 'required',
            'point' => 'required|numeric',
            'catatan' => 'required',
            'waktu' => 'required'
        ]);
    
        // Menambahkan ID guru ke dalam data pelanggaran
        $data['id'] = $guruId;
    
        Pelanggaran::create($data);
    
        return redirect('/pelanggaran')->with('toast_success', 'Data Berhasil Ditambahkan');
    }
    
    public function editplg($id_pelanggaran)  ///EDIT
    {
      // Mendapatkan ID guru yang sedang login
      $guruId = Auth::id();
    
      // Mendapatkan informasi guru berdasarkan ID
      $guru = Guru::find($guruId);
  
      // Mendapatkan data siswa
      $siswa = Siswa::all();
  
      // Mendapatkan data pelanggaran
      $pelanggaran = DB::table('tb_kategori_pelanggaran')->get();
        return view('edit.edit_pelanggaran', compact('id_pelanggaran','siswa', 'pelanggaran', 'guru'));
        // $pelanggaran = KetPelanggaran::find($id_pelanggaran);
        // return view('edit.edit_pelanggaran', compact(['pelanggaran']));
    }

    public function updateplg(Request $request, $id_pelanggaran)
    {
        $guruId = Auth::id();
        $data = $request->validate([
            'id_kategori_pelanggaran' => 'required',
            'id_siswa' => 'required',
            
            'point' => 'required',
            'catatan' => 'required',
            'waktu' => 'required'
            
        ]);
        $data['id'] = $guruId;
        $pelanggaran = Pelanggaran::where('id_pelanggaran', $id_pelanggaran)->first();
        $pelanggaran->update($data);
        return redirect('/pelanggaran')->with('toast_success', 'Data Berhasil Diupdate');
    }

    public function destroy1($id)
    {
        // Find the record
        $siswa = Pelanggaran::findOrFail($id);
        
        // Delete the record
        $siswa->delete();
        Pelanggaran::where('id_siswa',$id)->delete();
        
        // Redirect to the index page with a success message
        return redirect()->route('pelanggaran')->with('toast_success', 'Data Berhasil Dihapus');
    }


    // public function show($id_siswa)
    // {
    //     $pelanggaran=pelanggaran::all();
    //     return response()->json($pelanggaran);
    //   username
    //   password
    //   cek di db 
    //   kalo username sapa passwordnya benar nampiling smua datanya
    //   $data = Pelanggaran::where('id_siswa','=',$id_siswa)->get();
    //     if($data){
    //         return ApiFormatter::createApi(200, 'Succes',$data);
    //     }else{
    //         return ApiFormatter::createApi(400, 'Gagal');
    //     }   
    //  }

    public function show()
    {
        // $pelanggaran=pelanggaran::all();
        // return response()->json($pelanggaran);
        // username
        // password
        // cek di db 
        // kalo username sapa passwordnya benar nampiling smua datanya
        $data = PelanggaranSiswaCollection::collection(Pelanggaran::with(['ketpelanggaran', 'siswa'])->get());
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data_pelanggaran' => $data
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data',
                'data_pelanggaran' => null
            ]);
        }
    }
}
