@extends('layouts.app')
@section('title', __('headings.stays.edit'))

@section('page-header')
    <h1>
        <i class="fas fa-user-plus fa-fw mr-2 text-muted"></i>
        @lang('headings.stays.edit')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('voluntary.estadias.index') }}">
            @lang('breadcrumb.stays.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.edit')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="card card-secondary">
    <form class="form-horizontal" method="POST" action="{{ route('voluntary.estadias.update', $stay) }}">
        @method('PUT')
        <div class="card-body pb-0">
            @include('voluntary.stays._partials.form')
        </div>
        <div class="card-footer">
            @include('shared.update_buttons', ['urlBack' => route('voluntary.acolhidos.index')])
        </div>
    </form>
</div>
@endsection
@section('scripts')
    <script>
       console.log(new Date('{{ format_date($stay->entry_date ?? now()->format('Y/m/d'), 'd/m/Y') }}'))
    </script>
@endsection
