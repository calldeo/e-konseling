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
            'id_penghargaan' => $this->id_penghargaan,
            'waktu'=>$this->waktu,
            'kategori_penghargaan' => $this->ketpenghargaan->kategori_penghargaan,
            'id_siswa' => $this->siswa->id_siswa,
            'point' => $this->point,
            'catatan' => $this->catatan,
            
        ];
    }
}
