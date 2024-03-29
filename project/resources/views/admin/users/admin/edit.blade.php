@extends('layouts.app')
@section('title', __('headings.admin-users.edit'))

@section('page-header')
    <h1>
        <i class="fas fa-user-shield fa-fw mr-2 text-muted"></i>
        @lang('headings.admin-users.edit')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('admin.administradores.index') }}">
            @lang('breadcrumb.users-admin.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.edit')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="card card-secondary">
    <form class="form-horizontal" method="POST" action="{{ route('admin.administradores.update', $user->id) }}">
        @method('PUT')
        <div class="card-body pb-0">
            @include('admin.users.admin._partials.form')
        </div>
        <div class="card-footer">
            @include('shared.update_buttons', ['urlBack' => route('admin.administradores.index')])
        </div>
    </form>
</div>
@endsection
