@extends('layouts.app')
@section('title', __('headings.clients.forbidden_index'))

@section('page-header')
    <h1>
        <i class="fas fa-user-plus fa-fw mr-2 text-muted"></i>
        @lang('headings.clients.forbidden_index')
    </h1>

    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.clients.forbidden_index')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
    <data-list data-source="{{ route('voluntary.pagination.forbidden_clients') }}"/>

    <template id="data-list" slot-scope="modelScope">
        <div>
            <loader :show-loader="isLoading"></loader>
            <div class="card">
                <div class="card-header p-2">
                    @include('voluntary.clients._partials.tabs')
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md table-vcenter mb-0">
                            <thead>
                            @include('voluntary.clients._partials.head')
                            </thead>
                            <tbody>
                            <tr v-if="emptyResult">
                                @include('shared.empty_table')
                            </tr>
                            <template v-else>
                                <tr v-for="(item, index) in items" :key="index">
                                    @include('voluntary.clients._partials.body')
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </template>
@endsection