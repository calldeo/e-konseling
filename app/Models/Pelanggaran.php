<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Pelanggaran extends Authenticatable
{


    
        use HasFactory;
        protected $table = 'tb_pelanggaran';
        protected $guarded = [];
        protected $primaryKey = 'id_pelanggaran';
    

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_kategori_pelanggaran',
        'id_siswa',
        'id',
        'point',
        'catatan',
        'waktu',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
     public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function ketpelanggaran()
    {
        return $this->belongsTo(KetPelanggaran::class, 'id_kategori_pelanggaran');
    }
    
}
