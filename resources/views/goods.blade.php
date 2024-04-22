@extends('layouts.master')

@section("content")
    <h1>Карточки товаров</h1>

    <div class="grid-container">
        @foreach($goods as $good)
                <a href="{{ route('good', ['id' => $good->id]) }}" class="card">
                    <div class="card-body">
                        @for($i = 0; $i < count($images); $i++)
                            @if ($images[$i]['good_external_code'] === $good->external_code && strpos($images[$i]->image_path, "link"))
                                <div style="text-align: center;">
                                    <img src="{{ asset('storage' . str_replace("/var/www/html/storage/app/public", "", $images[$i]->image_path)) }}" alt="Изображение товара" style="max-width: 200px; max-height: 200px;">
                                </div>
                            @endif
                        @endfor
                        <h5 class="card-title">{{ $good->name }}</h5>
                        <p class="card-text">{{ $good->external_code }}</p>
                        <p class="card-text">{{ $good->description }}</p>
                        <p class="card-text price">Цена: {{ $good->price }} руб</p>
                        <p class="card-text discount">Скидка:
                            @if($good->discount) {{ $good->discount }}
                            @else 0
                            @endif руб
                        </p>
                    </div>
                </a>
        @endforeach
    </div>
@endsection
