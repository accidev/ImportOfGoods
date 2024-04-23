<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveImage(Request $request, int $rowLink)
    {
        // $rowLink - это строка в котором находятся ссылки на картинки, 36 - "Доп. поле: Ссылка на упаковку", 37 -"Доп. поле: Ссылки на фото"

        // Загруженный файл
        $files = $request->file('files');

        // Запись данных из файла Excel в массив
        $goods = Excel::toArray([], $files)[0];

        // Внешние ссылки
        $photoLinks = $this->getExternalLinks($goods, $rowLink);

        // Ссылки на локальную папку
        $uploadImages = $this->getLocalLinks($photoLinks, $rowLink);

        // Запись в БД
        $this->store($uploadImages);

        return $uploadImages;
    }

    // Массив внешних ссылок для скачивания
    public function getExternalLinks(array $goods, int $rowLink)
    {
        // Массив, в который будут записаны "Внешний код" и 'ссылка на картинку'
        $photoLinks = [];

        foreach ($goods as $good) {

            // В поле "Доп. поле: Ссылки на фото" несколько ссылок разделенные запятой, создаем массив этих ссылок
            // Если ссылка одна, то будет массив из одного значения
            $arrayLinks = explode(", ", $good[$rowLink]);

            // Запись в массив ['external_code' => Внешний код, 'link' => 'ссылка на картинку']
            foreach ($arrayLinks as $arrayLink) {
                $photoLinks[] = [

                    // $good[5] это "Внешний код"
                    'external_code' => $good[5],
                    'link' => $arrayLink
                ];
            }
        }
        return $photoLinks;
    }


    // Массив ссылок на локальную папку
    public function getLocalLinks(array $photoLinks, int $rowLink)
    {
        // Массив, в который будут записаны "Внешний код", "Название картинки" и "Ссылка на локальную папку"
        $uploadImages = [];

        foreach ($photoLinks as $photoLink) {
            foreach ($photoLink as $key => $link) {

                // Пропускаем первую строку в которую записались названия полей Excel файла
                if ($link === "Доп. поле: Ссылка на упаковку" or $link === 'Доп. поле: Ссылки на фото') {
                    continue;
                }

                // Если в локальную папку уже сохранена картинка с такой же внешней ссылкой
                if (in_array($link, array_column($uploadImages, 'link'))) {
                    foreach ($uploadImages as $upload) {

                        // Находим в сохраненном массиве $uploadImages, массив с одинаковой ссылкой
                        if ($upload['link'] === $link) {

                            // Задаем "Внешний код" нового товара
                            $goodExternalCode = $photoLink['external_code'];

                            // Задаем "Название картинки" и "Ссылка на локальную папку" которые уже записаны в $uploadImages
                            $fileName = $upload['fileName'];
                            $filePath = $upload['filePath'];

                            break;
                        }
                    }

                    // Запись в массив нового товара с присвоением названия и ссылки уже имеющейся такой же картинки
                    $uploadImages[] = [
                        'good_external_code' => $goodExternalCode,
                        'link' => $link,
                        'fileName' => $fileName,
                        'filePath' => $filePath,
                    ];
                    // Сохранение новой картинки
                }  elseif ($key === 'link') {
                    $imageContent = file_get_contents($link);

                    // Если "Доп. поле: Ссылка на упаковку" добавляем к названию картинки .link.jpg
                    if ($rowLink === 36) {
                        $fileName = str_replace(['http://catalog.collant.ru/pics/', '.jpg'], "", $link).'.link.jpg';

                        // Если "Доп. поле: Ссылки на фото" добавляем к названию картинки .photo.jpg
                    } elseif ($rowLink === 37) {
                        $fileName = str_replace(['http://catalog.collant.ru/pics/', '.jpg'], "", $link).'.photo.jpg';
                    }

                    // Пусть к каталогу хранения
                    $filePath = storage_path('app/public/uploads/' . $fileName);

                    // Запись картинки в каталог
                    file_put_contents($filePath, $imageContent);

                    // Запись в массив данных о картинке
                    $uploadImages[] = [
                        'good_external_code' => $photoLink['external_code'],
                        'link' => $link,
                        'fileName' => $fileName,
                        'filePath' => $filePath,
                    ];
                }
            }
        }
        return $uploadImages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Запись картинки в БД
    public function store(array $uploadImages)
    {
        foreach ($uploadImages as $uploadImage) {
            foreach ($uploadImage as $key => $value) {
                if ($key === 'good_external_code') {
                    $goodExternalCode = $value;
                } elseif ($key === 'fileName') {
                    $fileName = $value;
                } elseif ($key === 'filePath') {
                    $filePath = $value;
                }
            }

            $image = new Image;

            $image->good_external_code = $goodExternalCode;
            $image->image_name = $fileName;
            $image->image_path = $filePath;

            $image->save();
        }
    }
}
