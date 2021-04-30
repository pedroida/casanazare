@extends('layouts.app')
@section('title', 'Dashboard')

@section('page-header')
    <h1>
        <i class="fas fa-fire fa-fw mr-2 text-muted"></i>
        Dashboard Geral
    </h1>
@endsection

@section('content')

    @if(current_user()->hasRole(\App\Enums\UserRolesEnum::ADMIN))
        <admin-dashboard get-data-url="{{ route('ajax.admin.dashboard.get-data') }}"></admin-dashboard>
    @else
        <admin-dashboard get-data-url="{{ route('ajax.voluntary.dashboard.get-data') }}"></admin-dashboard>
    @endif
@endsection