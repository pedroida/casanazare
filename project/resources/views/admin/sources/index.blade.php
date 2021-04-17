@extends('layouts.app')
@section('title', __('headings.sources.index'))

@section('page-header')
    <h1>
        <i class="fas fa-building fa-fw mr-2 text-muted"></i>
        @lang('headings.sources.index')
    </h1>

    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.sources.index')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
    <data-list
        data-source="{{ route('admin.pagination.sources') }}"
        delete-message="@lang('flash.common.confirmation.destroy')"
        url-create="{{ route('admin.origens.create') }}"
        label-create="@lang('links.common.create')"
    />

    <template id="data-list" slot-scope="modelScope">
        <div>
            <loader :show-loader="isLoading"></loader>
            <div class="card">
                <div class="card-header">
                      @can('sources create')
                        <div class="col-12 text-right">
                            <a v-if="urlCreate"
                                class="btn btn-success" :href="urlCreate" data-toggle="tooltip" :title="labelCreate">
                                <i class="fas fa-plus fa-fw"></i>
                                @{{ labelCreate }}
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md table-vcenter mb-0">
                            <thead>
                                @include('admin.sources._partials.head')
                            </thead>
                            <tbody>
                                <tr v-if="emptyResult">
                                    @include('shared.empty_table')
                                </tr>
                                <template v-else>
                                    <tr v-for="(item, index) in items" :key="index">
                                        @include('admin.sources._partials.body')
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