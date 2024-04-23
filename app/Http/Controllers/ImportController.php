<?php

namespace App\Http\Controllers;

use App\Imports\AdditionalFieldImport;
use App\Imports\GoodsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importFile(Request $request)
    {
        try {
            DB::beginTransaction();

            Excel::import(new GoodsImport(), $request->file('files'));
            Excel::import(new AdditionalFieldImport(), $request->file('files'));

            $image = new ImageController();

            // Скачивание фотографий по ссылке, в локальную папку storage/app/public/uploads/
            // 36 - "Доп. поле: Ссылка на упаковку"
            $packageStorageLinks = $image->saveImage($request, 36);

            // 37 -"Доп. поле: Ссылки на фото"
            $photoStorageLinks = $image->saveImage($request, 37);

            DB::commit();

            return redirect('/')->with('success', 'Данные успешно импортированы.');
        } catch (\Exception $e) {
            DB::rollBack();

            $Storagelinks = [$packageStorageLinks,$photoStorageLinks];

            foreach ($Storagelinks as $links) {
                foreach ($links as $link) {
                    Storage::disk('public')->delete($link['filePath']);
                }
            }
            return redirect('/')->with('error', 'Ошибка при импорте файла: ' . $e->getMessage());
        }
    }
}
