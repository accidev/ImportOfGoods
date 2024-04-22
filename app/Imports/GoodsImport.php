<?php

namespace App\Imports;

use App\Models\Good;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GoodsImport implements ToModel, withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Good([
            'external_code' => $row['vnesnii_kod'],
            'name' => $row['naimenovanie'],
            'description' => $row['opisanie'],
            'price' => $row['cena_cena_prodazi'],
            'discount' => null,
        ]);
    }
}
