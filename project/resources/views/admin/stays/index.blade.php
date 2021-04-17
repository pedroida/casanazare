@extends('layouts.app')
@section('title', __('headings.stays.index'))

@section('head')
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

@endsection

@section('page-header')
    <h1>
        <i class="fas fa-user-plus fa-fw mr-2 text-muted"></i>
        @lang('headings.stays.index')
    </h1>

    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.stays.index')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
    <data-list
            data-source="{{ route('admin.pagination.stays') }}"
            delete-message="@lang('flash.common.confirmation.destroy')"
            url-create="{{ route('admin.estadias.create') }}"
            label-create="@lang('links.common.create')"
    />

    <template id="data-list" slot-scope="modelScope">
        <div>
            <loader :show-loader="isLoading"></loader>
            <div class="card">
                <div class="card-header">
                    @can('users create admin')

                        <div class="col-12 text-md-right">
                            <a v-if="urlCreate"
                               class="btn btn-success float-md-none float-left mr-md-2" :href="urlCreate" data-toggle="tooltip" :title="labelCreate">
                                <i class="fas fa-plus fa-fw"></i>
                                @{{ labelCreate }}
                            </a>

                            @can('stays import')
                                <import-spreadsheet
                                        class="float-right"
                                        post-url="{{ route('admin.estadias.import-spreadsheet') }}"
                                        button-label="@lang('labels.stays.import_spreadsheet')"
                                        input-label="@lang('labels.stays.import_spreadsheet_input_label')">
                                </import-spreadsheet>
                            @endif
                        </div>

                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md table-vcenter mb-0">
                            <thead>
                            @include('admin.stays._partials.head')
                            </thead>
                            <tbody>
                            <tr v-if="emptyResult">
                                @include('shared.empty_table')
                            </tr>
                            <template v-else>
                                <tr v-for="(item, index) in items" :key="index">
                                    @include('admin.stays._partials.body')
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

@section('scripts')
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
@endsection