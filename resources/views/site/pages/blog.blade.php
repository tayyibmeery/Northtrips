@extends('site.layout.app')

@section('title', 'Blog - ' . ($setting->company_name ?? 'North Trips & Travel'))
@section('page-title', 'Blog')

@section('content')
<!-- Content will be loaded dynamically via AJAX -->
@endsection
