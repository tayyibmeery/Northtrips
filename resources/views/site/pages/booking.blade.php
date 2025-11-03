@extends('site.layout.app')

@section('title', 'Tour Booking - ' . ($setting->company_name ?? 'North Trips & Travel'))
@section('page-title', 'Tour Booking')

@section('content')
<!-- Content will be loaded dynamically via AJAX -->
@endsection
