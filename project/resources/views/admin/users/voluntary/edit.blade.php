@extends('layouts.app')
@section('title', __('headings.voluntary-users.edit'))

@section('page-header')
    <h1>
        <i class="fas fa-user-shield fa-fw mr-2 text-muted"></i>
        @lang('headings.voluntary-users.edit')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('admin.voluntarios.index') }}">
            @lang('breadcrumb.users-voluntary.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.edit')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="card card-secondary">
    <form class="form-horizontal" method="POST" action="{{ route('admin.voluntarios.update', $user->id) }}">
        @method('PUT')
        <div class="card-body pb-0">
            @include('admin.users.voluntary._partials.form')
        </div>
        <div class="card-footer">
            @include('shared.update_buttons', ['urlBack' => route('admin.voluntarios.index')])
        </div>
    </form>
</div>
@endsection
