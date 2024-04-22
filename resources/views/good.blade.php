@extends('layouts.master')

@section("content")
    <h1>Информация о товаре: {{ $good->name }}</h1>

    <div class="card">
        <div class="card-body custom-card-body">
            <h5 class="card-title">{{ $good->name }}</h5>
            <p class="card-text">Код товара: {{ $good->external_code }}</p>
            <div style="text-align: center;">
                @for($i = 0; $i < count($images); $i++)
                    @if ($images[$i]['good_external_code'] === $good->external_code && strpos($images[$i]->image_path, "photo"))
                        <img src="{{ asset('storage' . str_replace("/var/www/html/storage/app/public", "", $images[$i]->image_path)) }}" alt="Изображение товара" style="max-width: 200px; max-height: 200px;">
                    @endif
                @endfor
            </div>
            <p class="card-text">{{ $good->description }}</p>
            <p class="card-text price">Цена: {{ $good->price }} руб</p>
            <p class="card-text discount">Скидка:
                @if($good->discount) {{ $good->discount }}
                @else 0
                @endif руб
            </p>

            <!-- Отображение дополнительных полей -->
            <p class="card-text">Размер: {{ $field->size }}</p>
            <p class="card-text">Цвет: {{ $field->color }}</p>
            <p class="card-text">Бренд: {{ $field->brand }}</p>
            <p class="card-text">Состав: {{ $field->compound }}</p>
            <p class="card-text">Количество в упаковке: {{ $field->quantity_per_package }}</p>
{{--            <p class="card-text">SEO-заголовок: {{ $field->seo_title }}</p>--}}
{{--            <p class="card-text">SEO-H1: {{ $field->seo_h1 }}</p>--}}
{{--            <p class="card-text">SEO-описание: {{ $field->seo_description }}</p>--}}
            <p class="card-text">Вес товара: {{ $field->product_weight }} г</p>
            <p class="card-text">Ширина: {{ $field->width }} мм</p>
            <p class="card-text">Высота: {{ $field->height }} мм</p>
            <p class="card-text">Длина: {{ $field->length }} мм</p>
            <p class="card-text">Вес упаковки: {{ $field->weight_of_packing }} г</p>
            <p class="card-text">Ширина упаковки: {{ $field->packing_width }} мм</p>
            <p class="card-text">Высота упаковки: {{ $field->package_height }} мм</p>
            <p class="card-text">Длина упаковки: {{ $field->packing_length }} мм</p>
            <p class="card-text">Категория товара: {{ $field->product_category }}</p>
        </div>
    </div>
@endsection
