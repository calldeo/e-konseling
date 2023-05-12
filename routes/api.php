<?php


use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
// use Auth; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();  
});
route::get('siswa',[SiswaController::class,'SiswaAPI']);

route::post('siswa',function(Request $request){
    $valid = Auth::attempt($request->all());

    if($valid){
        $siswa = Auth::Siswa();
        $siswa->api_token = Str::random(100);
        $siswa->save();

        // $user->makeVisible('api_token');

        return $siswa;
    }
    return response()->json([
        'message'=> 'email & password doesn\'t match'
    ],404);
});
