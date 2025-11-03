@extends('site.layout.app')

@section('title', 'Destinations - ' . ($setting->company_name ?? 'North Trips & Travel'))
@section('page-title', 'Destinations')

@section('content')
<!-- Content will be loaded dynamically via AJAX -->
@endsection
