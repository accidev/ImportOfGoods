@extends('layouts.master')
@section('content')
    <form action="/import" method="post" enctype="multipart/form-data">
        @include('layouts.partials.messages')
        @csrf
        <h1>Загрузить файл</h1>
        <div class="row">
            <input type="file" name="files"/>
        </div>
        <div class="row">
            <button type="submit">Загрузить</button>
        </div>

    </form>
@endsection
