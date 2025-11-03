@extends('site.layout.app')

@section('title', 'Explore Tours - ' . ($setting->company_name ?? 'North Trips & Travel'))
@section('page-title', 'Explore Tours')

@section('content')
<!-- Content will be loaded dynamically via AJAX -->
@endsection
