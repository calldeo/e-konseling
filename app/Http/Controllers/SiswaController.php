<?php

namespace App\Http\Controllers;

use App\API\ApiFormatter;
use App\Imports\UserImport;
use App\Imports\SiswaImport;

use DB;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\SiswaAPImodel;
use Exception;
use Illuminate\Support\Facades\Auth;
use lluminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr;

class SiswaController extends Controller
{

    public function siswaimportexcel(Request $request) {
        $file=$request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataSiswa', $namafile);

        Excel::import(new SiswaImport, public_path('/DataSiswa/'.$namafile));
        return redirect('/siswa');
    }






    public function siswa(Request $request){
        $search=$request->search; 
        $siswa = DB::table('tb_siswa')->where('nama','LIKE','%'.$request->search.'%')
                                        ->orwhere('nisn','LIKE','%'.$request->search.'%')->Paginate(10);
        return view('halaman.siswa',['siswa' => $siswa],['search'=>$search]);
    }


    public function tambahsiswa(){
        return view('tambah.tambah_siswa');
      }
      public function store(Request $request )
      {   
          try{
          DB::table('tb_siswa')->insert([
            
              'nisn' => $request->nisn,
              'nama' =>$request->nama,
              'kelas' =>$request->kelas,
              'email' => $request->email,
              'password' => bcrypt($request->password),
             

          ]);
      
          
          return redirect('/siswa')->with('toast_success', 'Data Berhasil Ditambahkan');
        }catch(Exception $e){
          $message = match(true){
            $e->getCode()==23000=>'post alredy exits',
            default => 'post update failed'
          };
          return back()->with('toast_succes', $message);
        }
      }

      public function destroy($id) ///DELETE
      {
          $siswa = Siswa::find($id);
          $siswa->delete();
          return redirect('/siswa')->with('toast_success', 'Data Berhasil Dihapus');
      }
      
      public function edit($id)  ///EDIT
      {
          $siswa = Siswa::find($id);
          return view('edit.edit_siswa',compact(['siswa']));
      }
      
      public function update(Request $request, $id)
  {
     DB::table('tb_siswa')->where('id_siswa',$request->id_siswa)->update([
        'nisn' => $request->nisn,
        'nama' =>$request->nama,
        'kelas' =>$request->kelas,
        'email' => $request->email,
        'password' => bcrypt($request->password),
     ]);
      return redirect('/siswa')->with('toast_success', 'Data Berhasil Diupdate');
  }
  public function search(Request $request)
  {
    if($request->has('search')){
        $siswa = Siswa::where('nama','LIKE','%'.$request->search.'%')->get();
    }
    else{
        $siswa= Siswa::all();
    }
    return view('halaman.siswa',['siswa' =>$siswa]);
  }

  public function viewimport(){
        return view('import.importsiswa');
    
  }
  public function SiswaAPI()
    {
      // username
      // password
      // cek di db 
      // kalo username sapa passwordnya benar nampiling smua datanya
      $data = SiswaAPImodel::all();
        if($data){
            return ApiFormatter::createApi(200, 'Succes',$data);
        }else{
            return ApiFormatter::createApi(400, 'Gagal');
        }    }


        public function loginapi(Request $request)
        {
            $credentials = $request->only('email', 'password');
    
            if (Auth::guard('siswa')->attempt($credentials)) {
                $auth = Auth::guard('siswa')->user();
                $auth['token']=$auth->createToken('auth_token')->plainTextToken;
    
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil' ,
                    'data' => $auth
                ]);
            } else {
                return response()->json([
                   
                    'success' => false,
                    'message' => 'Email atau password salah',
                    'data' => null
                    
                ]);
            }
        }
    }

        
