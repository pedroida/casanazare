@extends('layouts.app')
@section('title', __('headings.clients.create'))

@section('page-header')
    <h1>
        <i class="fas fa-user-plus fa-fw mr-2 text-muted"></i>
        @lang('headings.clients.create')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('admin.acolhidos.index') }}">
            @lang('breadcrumb.clients.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.create')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="card card-secondary">
    <form class="form-horizontal" method="POST" action="{{ route('admin.acolhidos.store') }}">
        <div class="card-body pb-0">
            @include('admin.clients._partials.form')
        </div>
        <div class="card-footer">
            @include('shared.create_buttons', ['urlBack' => route('admin.acolhidos.index')])
        </div>
    </form>
</div>
@endsection
