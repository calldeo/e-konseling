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
use Illuminate\Support\Facades\Validator;
use lluminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr;

class SiswaController extends Controller
{

    public function siswaimportexcel(Request $request) {

        DB::table('tb_siswa')->truncate();

        $file=$request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataSiswa', $namafile);

        Excel::import(new SiswaImport, public_path('/DataSiswa/'.$namafile));
        return redirect('/siswa')->with('toast_success', 'Data Berhasil Ditambahkan');;
        
    }






    public function siswa(Request $request){
        // $search=$request->search; 
        // $siswa = DB::table('tb_siswa')->where('nama','LIKE','%'.$request->search.'%')
        //                                 ->orwhere('nisn','LIKE','%'.$request->search.'%')->Paginate(10);
        // return view('halaman.siswa',['siswa' => $siswa],['search'=>$search]);
       
             $search=$request->search; 
            $data = Siswa::where('nama','LIKE','%'.$request->search.'%') ->orwhere('nisn','LIKE','%'.$request->search.'%')->Paginate(5);
            return view('halaman.siswa', compact('data'),['search'=>$search]);
        
    }


    public function tambahsiswa(){
        return view('tambah.tambah_siswa');
      }
      public function store(Request $request )
      {   
        $data = $request->validate([
            'nisn' => ['required','min:9','max:12','unique:tb_siswa,nisn'],
            'nama' => ['required','min:3','max:30'],
            'kelas'=> 'required',
            'email' => 'required|unique:tb_siswa,email',
            'password' => ['required','min:8','max:12'],
            
            
        ]);

        // $text([

        //     'nisn.required'=>"data tidak boleh kosong",
        //     'nisn.min'=>"Nisn Minimal 9 karakter",
        //     'nisn.max'=>"Nisn Maksimal 12 karakter",
        //     'nama.required'=>"data tidak boleh kosong",
        //     'nama.min'=>"Nama Minimal 3 karakter",
        //     'nama.max'=>"nama Maksimal 30 karakter",
        //     'kelas.required'=>"data tidak boleh kosong",
        //     'email.required'=>"data tidak boleh kosong",
        //     'email.unique'=>"data tidak boleh kosong",
        //     'password.required'=>"data tidak boleh kosong",
        //     'password.min'=>"Password Minimal 8 karakter",
        //     'password.max'=>"Password Maksimal 12 karakter",

            
        // ]);

        // $validasi = Validator::make($request->all(),$data,$text);

        DB::table('tb_siswa')->insert([
            
            'nisn' => $request->nisn,
            'nama' =>$request->nama,
            'kelas' =>$request->kelas,
            'email' => $request->email,
            'password' => bcrypt($request->password),
           
            

        ]);

      
            
            return redirect('/siswa')->with('toast_success', 'Data Berhasil Ditambahkan');
                


        //   try{
        //   DB::table('tb_siswa')->insert([
            
        //       'nisn' => $request->nisn,
        //       'nama' =>$request->nama,
        //       'kelas' =>$request->kelas,
        //       'email' => $request->email,
        //       'password' => bcrypt($request->password),
             

        //   ]);
      
          
        //   return redirect('/siswa')->with('toast_success', 'Data Berhasil Ditambahkan');
        // }catch(Exception $e){
        // //   $message = match(true){
        // //     $e->getCode()==23000=>'post alredy exits',
        // //     default => 'post update failed'
        // //   };
        // //   return view('siswa')->with('toast_success', 'Data Berhasil Ditambahkan');
        // }
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
    $data = $request->validate([
        'nisn' => ['required','min:9','max:12','unique:tb_siswa,nisn'],
        'nama' => ['required','min:3','max:30'],
        'kelas'=> 'required',
        'email' => 'required|unique:tb_siswa,email',
        'password' => ['required','min:8','max:12'],
        
        
    ]);
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
        }   
     }


     public function updateAPI(Request $request,$id_siswa)
     {
        // if($request->wantsJson()) {
        //     return response()->json(['P+'], 200);
        // }
        
            $request ->validate([
                // 'nisn' => ['required','min:9','max:12','unique:tb_siswa,nisn'],
                //  'nama' => ['required','min:3','max:30'],
                //  'kelas'=> 'required',
                //  'email' => 'required|unique:tb_siswa,email',
                'password' => ['required','min:8','max:12'],
        
            ]);
            
            $tb_siswa = Siswa::findOrFail($id_siswa);

            $tb_siswa->update([
                // 'nisn' => $request->nisn,
                // 'nama' =>$request->nama,
                // 'kelas' =>$request->kelas,
                // 'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

        $data = Siswa::where('id_siswa','=',$tb_siswa->id_siswa)->get();
        
        if($data){
            return ApiFormatter::createApi(200, 'Success',$data);
        }else{
            return ApiFormatter::createApi(400,'Failed'); 
        }
       
     }


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

        
