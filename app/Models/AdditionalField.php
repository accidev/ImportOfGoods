<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalField extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'color',
        'brand',
        'compound',
        'quantity_per_package',
        'packaging_link',
        'photo_links',
        'seo_title',
        'seo_h1',
        'seo_description',
        'product_weight',
        'width',
        'height',
        'length',
        'weight_of_packing',
        'packing_width',
        'package_height',
        'packing_length',
        'product_category',
        'good_external_code',
    ];
}
