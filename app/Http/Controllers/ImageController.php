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

    public function saveImage(Request $request, int $row)
    {
        $link = $request->file('files');

        $goods = Excel::toArray([], $link)[0];

        $photoLinks = [];

        foreach ($goods as $good) {
            $arrayLinks = explode(", ", $good[$row]);

            foreach ($arrayLinks as $arrayLink) {
                $photoLinks[] = [
                    'external_code' => $good[5],
                    'link' => $arrayLink
                ];
            }
        }

        $uploadImages = [];

        foreach ($photoLinks as $photoLink) {
            foreach ($photoLink as $key => $link) {
                if ($link === "Доп. поле: Ссылка на упаковку" or $link === 'Доп. поле: Ссылки на фото') {
                    continue;
                }

                if (in_array($link, array_column($uploadImages, 'link'))) {
                    foreach ($uploadImages as $upload) {
                        if ($upload['link'] === $link) {
                            $goodExternalCode = $photoLink['external_code'];
                            $fileName = $upload['fileName'];
                            $filePath = $upload['filePath'];
                            break;
                        }
                    }

                    $uploadImages[] = [
                        'good_external_code' => $goodExternalCode,
                        'link' => $link,
                        'fileName' => $fileName,
                        'filePath' => $filePath,
                    ];
                }  elseif ($key === 'link') {
                    $imageContent = file_get_contents($link);

                    if ($row === 36) {
                        $fileName = str_replace(['http://catalog.collant.ru/pics/', '.jpg'], "", $link).'.link.jpg';

                    } elseif ($row === 37) {
                        $fileName = str_replace(['http://catalog.collant.ru/pics/', '.jpg'], "", $link).'.photo.jpg';
                    }

                    $filePath = storage_path('app/public/uploads/' . $fileName);

                    file_put_contents($filePath, $imageContent);

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
    public function store(array $linkUploadImages)
    {
        foreach ($linkUploadImages as $linkUploadImage) {
            foreach ($linkUploadImage as $linkUpload) {
                foreach ($linkUpload as $key => $value) {
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
}
