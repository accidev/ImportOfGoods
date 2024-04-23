<?php

namespace App\Http\Controllers;

use App\Models\AdditionalField;
use App\Models\Good;
use App\Models\Image;
use Illuminate\Support\Facades\Schema;
class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Schema::hasTable('goods')) {
            return view('goods');
        }

        $goods = Good::all();
        $additionalFields = AdditionalField::all();
        $images = Image::all();

        return view('goods', [
            'goods' => $goods,
            'additionalFields' => $additionalFields,
            'images' => $images,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadFile()
    {
        return view('uploadFile',[]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function show(int $goodId)
    {
        $good = Good::find($goodId);

        if (!$good) {
            abort(404);
        }

        $field = AdditionalField::where('good_external_code', $good['external_code'])->get();

        $images = Image::where('good_external_code', $good['external_code'])->get();

        return view('good', [
            'good' => $good,
            'field' => $field[0],
            'images' => $images
        ]);
    }
}
