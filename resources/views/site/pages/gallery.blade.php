@extends('site.layout.app')

@section('title', 'Gallery - ' . ($setting->company_name ?? 'North Trips & Travel'))
@section('page-title', 'Gallery')

@section('content')
<!-- Content will be loaded dynamically via AJAX -->
@endsection
