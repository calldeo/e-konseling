<?php

namespace App\Http\Controllers;

use App\API\ApiFormatter;
use App\Http\Resources\PenghargaanSiswaCollection;
use App\Imports\PenghargaanExport;
use App\Models\Guru;
use App\Models\KetPenghargaan;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penghargaan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PenghargaanController extends Controller
{
    
    public function exportPenghargaan()
   {
                // return Pelanggaran::with('siswa','ketpelanggaran','user')->get();
    return Excel::download(new PenghargaanExport(), 'penghargaan.xlsx');
   }

    public function penghargaan(Request $request)
    {  $search = $request->search;
        $data = Penghargaan::whereHas('siswa', function ($query) use ($search) {
                $query->where('nama', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10);
        $data->appends(['search' => $search]);
        return view('halaman.penghargaan', compact('data', 'search'));
    }
    public function ketpenghargaan(Request $request)
    {
        $search=$request->search;
        $ket = DB::table('tb_kategori_penghargaan')->where('kategori_penghargaan','LIKE','%'.$request->search.'%')->Paginate(5);
        return view('halaman.ketpenghargaan', ['ketpenghargaan' => $ket],['search'=>$search]);
    }

    public function tambahketphg()
    {
        return view('tambah.tambah_ketphg');
    }
    public function store(Request $request)
    {

        $request->validate([
            'kategori_penghargaan' => ['required', 'min:5', 'max:30'],
            'deskripsi_penghargaan'=> ['required', 'min:5', 'max:30'],
            'point' => ['required', 'min:5', 'max:30','number'],
            
            // 'password_confirmation' => 'required|same:password',
        ]);
        DB::table('tb_kategori_penghargaan')->insert([
            'kategori_penghargaan' => $request->kategori_penghargaan,
            'deskripsi_penghargaan' => $request->deskripsi_penghargaan,
            'point' => $request->point,



        ]);


        return redirect('/ketpenghargaan')->with('toast_success', 'Data Berhasil Ditambahkan');
    }

    public function destroy($id_kategori_penghargaan) ///DELETE
    {
        $ket = KetPenghargaan::find($id_kategori_penghargaan);
        $ket->delete();
        return redirect('/ketpenghargaan')->with('toast_success', 'Data Berhasil Dihapus');;
    }
    public function edit($id_kategori_penghargaan)  ///EDIT
    {
        $ket = KetPenghargaan::find($id_kategori_penghargaan);
        return view('edit.edit_ketpenghargaan', compact(['ket']));
    }

    public function update(Request $request, $id_kategori_pelanggaran)
    {
        $request->validate([
            'kategori_penghargaan' => ['required', 'min:5', 'max:30'],
            'deskripsi_penghargaan'=> ['required', 'min:5', 'max:30'],
            'point' => ['required', 'min:5', 'max:30','number'],
            
            // 'password_confirmation' => 'required|same:password',
        ]);
        DB::table('tb_kategori_penghargaan')->where('id_kategori_penghargaan', $request->id_kategori_penghargaan)->update([
            'kategori_penghargaan' => $request->kategori_penghargaan,
            'deskripsi_penghargaan' => $request->deskripsi_penghargaan,
            'point' => $request->point,
        ]);
        return redirect('/ketpenghargaan')->with('toast_success', 'Data Berhasil Diupdate');
    }

    //PENGHARGAAN


    public function tambahphg()
    {   // Mendapatkan ID guru yang sedang login
        $guruId = Auth::id();
    
        // Mendapatkan informasi guru berdasarkan ID
        $guru = Guru::find($guruId);
    
        // Mendapatkan data siswa
        $siswa = Siswa::all();
    
        // Mendapatkan data pelanggaran
        $penghargaan = DB::table('tb_kategori_penghargaan')->get();
    
        // Menampilkan view tambah pelanggaran dengan data siswa, pelanggaran, dan guru
        return view('tambah.tambah_phg', compact('siswa', 'penghargaan', 'guru'));
    }
    public function storephg(Request $request)
    {
        $guruId = Auth::id();
        $data = $request->validate([
            'id_kategori_penghargaan' => 'required',
            'id_siswa' => 'required',
            'point' => 'required',
            'catatan' => 'required',
            'waktu'=> 'required'
        ]);
        $data['id'] = $guruId;
        // dd($data);
        Penghargaan::create($data);
        // DB::table('tb_pelanggaran')->insert([
        //     'id_kategori_pelanggaran' => $request->id_kategori_pelanggaran,
        //     'id_siswa'=>$request->id_siswa,
        //     'id'=>$request->id,
        //     'point' => $request->point,
        //     'catatan'=>$request->catatan,
        // ]);
        return redirect('/penghargaan');
    }
    public function editphg($id_penghargaan)  ///EDIT
    {
        $siswa = Siswa::all();
        $penghargaan = DB::table('tb_kategori_penghargaan')->get();
        $guru = User::where('level', 'guru')->get();
        return view('edit.edit_penghargaan', compact('id_penghargaan','siswa', 'penghargaan', 'guru'));
        // $pelanggaran = KetPelanggaran::find($id_pelanggaran);
        // return view('edit.edit_pelanggaran', compact(['pelanggaran']));
    }

    public function updatephg(Request $request, $id_penghargaan)
    {
        
        $data = $request->validate([
            'id_kategori_penghargaan' => 'required',
            'id_siswa' => 'required',
            'id' => 'required',
            'point' => 'required',
            'catatan' => 'required',
            'waktu'  => 'required',
            
        ]);
        $penghargaan = Penghargaan::where('id_penghargaan', $id_penghargaan)->first();
        $penghargaan->update($data);
        return redirect('/penghargaan')->with('toast_success', 'Data Berhasil Diupdate');
    }

    public function destroy1($id_penghargaan) ///DELETE
    {
        $ket1 = Penghargaan::find($id_penghargaan);
        $ket1->delete();
        return redirect('/penghargaan')->with('toast_success', 'Data Berhasil Dihapus');;
    }


    public function show()
    {
        // $pelanggaran=pelanggaran::all();
        // return response()->json($pelanggaran);
        // username
        // password
        // cek di db 
        // kalo username sapa passwordnya benar nampiling smua datanya
        $data = PenghargaanSiswaCollection ::collection(Penghargaan::with(['ketpenghargaan', 'siswa'])->get());
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data_penghargaan' => $data
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data',
                'data_penghargaan' => null
            ]);
        }
    }
}
