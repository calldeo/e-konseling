<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Authenticatable
{


    
        use HasFactory;
        protected $table = 'tb_siswa';
<<<<<<< HEAD
        protected $guarded ='tb_siswa';
=======
        protected $guarded = [];
>>>>>>> 5320b8a665490443f655e8a1ff560dfa47e9a309
        protected $primaryKey = 'id_siswa';
    

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'email',
        'password',
<<<<<<< HEAD
        // 'api_token',
=======
        'api_token',
>>>>>>> 5320b8a665490443f655e8a1ff560dfa47e9a309
    ];
    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_siswa');
    }

    public function penghargaan()
    {
        return $this->hasMany(Penghargaan::class, 'id_siswa');
    }
    protected $hidden = [
        // 'password',
        // 'remember_token',
       
    ];
}
