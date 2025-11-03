@extends('site.layout.app')

@section('title', 'Travel Guides - ' . ($setting->company_name ?? 'North Trips & Travel'))
@section('page-title', 'Travel Guides')

@section('content')
<!-- Content will be loaded dynamically via AJAX -->
@endsection
