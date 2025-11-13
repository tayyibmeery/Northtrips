@extends('site.layout.app')
@section('title', 'Explore Tours - ' . ($setting->company_name ?? 'North Trips & Travel'))

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Explore Tours</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Tours</li>
        </ol>
    </div>
</div>

@include('site.components.Explore')
@endsection
