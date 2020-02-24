<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoicePembelianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "nama_perusahaan" => $this->nama_perusahaan,
            "tanggal_penerimaan" => $this->nama_perusahaan,
        ];
    }
}
