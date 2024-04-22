<?php

namespace App\Imports;

use App\Models\AdditionalField;
use App\Models\Good;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdditionalFieldImport implements ToModel, withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AdditionalField([
            'size'     => $row['dop_pole_razmer'],
            'color'     => $row['dop_pole_cvet'],
            'brand'     => $row['dop_pole_brend'],
            'compound'     => $row['dop_pole_sostav'],
            'quantity_per_package'     => $row['dop_pole_kol_vo_v_upakovke'],
            'packaging_link'     => $row['dop_pole_ssylka_na_upakovku'],
            'photo_links'     => $row['dop_pole_ssylki_na_foto'],
            'seo_title'     => $row['dop_pole_seo_title'],
            'seo_h1'     => $row['dop_pole_seo_h1'],
            'seo_description'     => $row['dop_pole_seo_description'],
            'product_weight'     => $row['dop_pole_ves_tovarag'],
            'width'     => $row['dop_pole_sirinamm'],
            'height'     => $row['dop_pole_vysotamm'],
            'length'     => $row['dop_pole_dlinamm'],
            'weight_of_packing'     => $row['dop_pole_ves_upakovkig'],
            'packing_width'     => $row['dop_pole_sirina_upakovkimm'],
            'package_height'     => $row['dop_pole_vysota_upakovkimm'],
            'packing_length'     => $row['dop_pole_dlina_upakovkimm'],
            'product_category'     => $row['dop_pole_kategoriia_tovara'],
            'good_external_code'     => $row['vnesnii_kod'],
        ]);
    }
}
