@extends('layouts.master')
@section('content')
    <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file">
        <button type="submit">Загрузить</button>
    </form>
@endsection
