@extends('voyager::master')

@section('page_title', __('Меню'))

@section('content')
    <!-- Для решение конфликтов стилей вставляем iframe -->
    <iframe src="{{url('admin/menu-iframe')}}" frameborder="0" style="width: 100%;height: 100vh;"></iframe>
@stop