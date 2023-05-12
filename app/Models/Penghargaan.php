<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Penghargaan extends Authenticatable
{


    
        use HasFactory;
        protected $table = 'tb_penghargaan';
        protected $guarded = [];
        protected $primaryKey = 'id_penghargaan';
    

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_kategori_penghargaan',
        'id_siswa',
        'id',
        'point',
        'catatan',
        
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
    public function ketpenghargaan()
    {
        return $this->belongsTo(KetPenghargaan::class, 'id_kategori_penghargaan');
    }
    
}
