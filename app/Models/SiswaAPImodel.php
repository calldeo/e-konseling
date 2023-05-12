<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaAPImodel extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa';
    protected $id = 'id_siswa';
    public $timestamps = false;
    protected $fillable = [
        'id_siswa',
        'nisn',
        'nama',
        'kelas',
        'email',
        'password',
    ];
    protected $hidden = [];
}
