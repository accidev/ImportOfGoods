<?php

namespace App\Http\Controllers;

use App\Imports\AdditionalFieldImport;
use App\Imports\GoodsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importExcel(Request $request)
    {
        try {

            Excel::import(new GoodsImport(), $request->file('files'));
            Excel::import(new AdditionalFieldImport(), $request->file('files'));

            $image = new ImageController();

            // Скачивание фотографий по ссылке, в локальную папку storage/app/public/uploads/
            $packagingLinks = $image->saveImage($request, 36);
            $photoLinks = $image->saveImage($request, 37);

            // Запись в БД
            $image->store([$packagingLinks, $photoLinks]);

            return redirect('/')->with('success', 'Данные успешно импортированы.');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Ошибка при импорте файла: ' . $e->getMessage());
        }
    }
}
