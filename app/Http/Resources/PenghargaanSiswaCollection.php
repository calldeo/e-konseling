<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenghargaanSiswaCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_siswa' => $this->siswa->id_siswa,
            'nama' => $this->siswa->nama,
            'waktu' => $this->created_at,
            'kategori_penghargaan' => $this->ketpenghargaan->kategori_penghargaan,
            'kelas' => $this->siswa->kelas
        ];
    }
}
