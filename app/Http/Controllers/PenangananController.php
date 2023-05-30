<?php

namespace App\Http\Controllers;

use App\Imports\PenangananExport;
use App\Models\Guru;
use DB;
use Illuminate\Http\Request;
use App\Models\ketpenanganan;
use App\Models\Pelanggaran;
use App\Models\Penanganan;
use App\Models\Penghargaan;
use App\Models\Siswa;
use App\Http\Controllers\PenangananSiswaCollection;
use App\Http\Resources\PenangananSiswaCollection as ResourcesPenangananSiswaCollection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Facades\Excel;

class PenangananController extends Controller
{

    public function exportPenanganan()
    {
        // return Pelanggaran::with('siswa','ketpelanggaran','user')->get();
        return Excel::download(new PenangananExport(), 'penanganan.xlsx');
    }
    public function penanganan(Request $request)
    {
        $search = $request->search;
        $data = Penanganan::whereHas('siswa', function ($query) use ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
        })->paginate(10);
        return view('halaman.penanganan', compact('data'));
        // dd($data);
    }

    public function ketpenanganan()
    {
        $ket = DB::table('tb_kategori_penanganan')->get();
        return view('halaman.ketpenanganan', ['ketpenanganan' => $ket]);
    }

    public function tambahketpng()
    {
        return view('tambah.tambah_ketpng');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_penanganan' => ['required', 'min:5', 'max:1000'],
            'catatan' => ['required', 'min:5', 'max:1000'],


            // 'password_confirmation' => 'required|same:password',
        ]);
        DB::table('tb_kategori_penanganan')->insert([
            'nama_kategori_penanganan' => $request->nama_kategori_penanganan,
            'catatan' => $request->catatan,
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
        return view('edit.edit_ketpenanganan', compact(['ket']));
    }

    public function update(Request $request, $id_kategori_penanganan)
    {
        $request->validate([
            'nama_kategori_penanganan' => ['required', 'min:5', 'max:1000'],
            'catatan' => ['required', 'min:5', 'max:1000'],


            // 'password_confirmation' => 'required|same:password',
        ]);
        DB::table('tb_kategori_penanganan')->where('id_kategori_penanganan', $request->id_kategori_penanganan)->update([
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

        $pelanggaran = Pelanggaran::with('siswa')->get();

        $siswa = Siswa::all();

        // Menampilkan view tambah penanganan dengan data siswa, pelanggaran, dan guru
        return view('tambah.tambah_png', compact('guru', 'pelanggaran', 'siswa'));
    }

    public function storepng(Request $request)
    {
        $guruId = Auth::id();

        $request->validate([
            'id_kategori_pelanggaran' => 'required',
            'id_siswa' => 'required',
            'status' => 'required',
            'tindak_lanjut' => 'required',
            'point' => 'required',
        ]);

        $penanganan = new Penanganan();
        $penanganan->id_kategori_pelanggaran = $request->id_kategori_pelanggaran;
        $penanganan->id_siswa = $request->id_siswa;
        $penanganan->status = $request->status;
        $penanganan->tindak_lanjut = $request->tindak_lanjut;
        $penanganan->point = $request->point;

        // Set field lain yang diperlukan untuk model Penanganan
        $penanganan->id_guru = $guruId;
        // Contoh: $penanganan->siswa_id = $request->siswa_id;
        //        $penanganan->keterangan = 'Penanganan default';

        $penanganan->save();

        return redirect()->back()->with('success', 'Data penanganan berhasil ditambahkan!');
    }

    public function destroy1($id)
    {
        // Find the record
        $siswa = Penanganan::findOrFail($id);

        // Delete the record
        $siswa->delete();
        Penanganan::where('id_siswa', $id)->delete();

        // Redirect to the index page with a success message
        return redirect()->route('penanganan')->with('toast_success', 'Data Berhasil Dihapus');
    }

    public function editpng($id_penanganan)  ///EDIT
    {
        // Mendapatkan ID guru yang sedang login
        $guruId = Auth::id();

        // Mendapatkan informasi guru berdasarkan ID
        $guru = Guru::find($guruId);

        // Mendapatkan data siswa
        $siswa = Siswa::all();


        $penanganan = Penanganan::where('id_penanganan', $id_penanganan)->first();
        // Mendapatkan data pelanggaran
        $pelanggaran = DB::table('tb_pelanggaran')->get();
        return view('edit.edit_penanganan', compact('id_penanganan', 'siswa', 'pelanggaran', 'guru', 'penanganan'));
        // $pelanggaran = KetPelanggaran::find($id_pelanggaran);
        // return view('edit.edit_pelanggaran', compact(['pelanggaran']));
    }

    public function updatepng(Request $request, $id_penanganan)
    {
        $guruId = Auth::id();
        $data = $request->validate([
            // 'id_siswa' => 'required',
            'point' => 'required',
            'status' => 'required',
            'tindak_lanjut' => 'required',


        ]);
        $data['id'] = $guruId;
        $penghargaan = Penanganan::where('id_penanganan', $id_penanganan)->first();
        $penghargaan->update($data);
        return redirect('/penanganan')->with('toast_success', 'Data Berhasil Diupdate');
    }

    public function show()
    {
        $data = ResourcesPenangananSiswaCollection::collection(Penanganan::with(['ketpelanggaran', 'siswa'])
            ->latest('created_at')->get());
        if ($data) {
            return response()->json([
                'succes' => true,
                'message' => 'Berhasil mengambil data',
                'data_penanganan' => $data
            ]);
        } else {
            return response()->json([
                'succes' => false,
                'message' => 'Gagal mengambil data',
                'data_penanganan' => null
            ]);
        }
    }
}
