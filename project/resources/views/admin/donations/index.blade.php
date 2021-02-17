@extends('layouts.app')
@section('title', __('headings.donations.index'))

@section('page-header')
    <h1>
        <i class="fas fas fa-box-open fa-fw mr-2 text-muted"></i>
        @lang('headings.donations.index')
    </h1>

    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.donations.index')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
    <data-list
        data-source="{{ route('admin.pagination.donations') }}"
        delete-message="@lang('flash.common.confirmation.destroy')"
        url-create="{{ route('admin.doacoes.create') }}"
        label-create="@lang('links.common.create')"
    />

    <template id="data-list" slot-scope="modelScope">
        <div>
            <loader :show-loader="isLoading"></loader>
            <div class="card">
                <div class="card-header">
                    <input type="text" v-model="query"
                        class="form-control col-md-4 mb-2 mb-md-0"
                        placeholder="@lang('placeholders.common.search')">

                    @can('donations create')
                        <div class="col-md-4 offset-md-4 text-right">
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
                                @include('admin.donations._partials.head')
                            </thead>
                            <tbody>
                                <tr v-if="emptyResult">
                                    @include('shared.empty_table')
                                </tr>
                                <template v-else>
                                    <tr v-for="(item, index) in items" :key="index">
                                        @include('admin.donations._partials.body')
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