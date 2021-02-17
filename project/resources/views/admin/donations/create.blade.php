@extends('layouts.app')
@section('title', __('headings.donations.create'))

@section('page-header')
    <h1>
        <i class="fas fas fa-box-open fa-fw mr-2 text-muted"></i>
        @lang('headings.donations.create')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('admin.doacoes.index') }}">
            @lang('breadcrumb.donations.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.create')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="card card-secondary">
    <form class="form-horizontal" method="POST" action="{{ route('admin.doacoes.store') }}">
        <div class="card-body pb-0">
            @include('admin.donations._partials.form')
        </div>
        <div class="card-footer">
            @include('shared.create_buttons', ['urlBack' => route('admin.doacoes.index')])
        </div>
    </form>
</div>
@endsection
