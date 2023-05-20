<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelanggaranAPImodel extends Model
{
   
    use HasFactory;
    protected $table = 'tb_pelanggaran';
    protected $guarded = [];
    protected $primaryKey = 'id_pelanggaran';
    public $timestamps = false;
    protected $fillable = [
        'id_kategori_pelanggaran',
        'id_siswa',
        'id',
        'point',
        'catatan',
        'waktu',
    ];
    protected $hidden = [];
}
