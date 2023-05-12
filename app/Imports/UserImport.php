<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nisn'=> $row['nisn'],
            'nama'=> $row['nama'],
            'kelas'=> $row['kelas'],
            'email'=> $row['password'],
            'password'=> Hash::make($row['password'])
        ]);
    }
}
