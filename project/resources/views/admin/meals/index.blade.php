@extends('layouts.app')
@section('title', __('headings.meals.index'))

@section('page-header')
    <h1>
        <i class="fas fa-utensils fa-fw mr-2 text-muted"></i>
        @lang('headings.meals.index')
    </h1>

    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.meals.index')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('modal-section')
    <meal-modal
            store-url="{{ route('admin.refeicoes.store') }}"
            update-url="{{ route('admin.refeicoes.update', ':id') }}">
    </meal-modal>
@endsection

@section('content')
    <data-list
            data-source="{{ route('admin.pagination.meals') }}"
            delete-message="@lang('flash.common.confirmation.destroy')"
            label-create="@lang('labels.common.create_meal')"
    />

    <template id="data-list" slot-scope="modelScope">

        <div>

            <loader :show-loader="isLoading"></loader>

            <div class="card">
                <div class="card-header">

                    <div class="col-md-2 col-12">
                        <filter-date url-key="day"></filter-date>
                    </div>

                    @can('meals create')
                        <div class="col-md-4 offset-md-6 text-right">
                            <a @click="$root.$emit('createMeal')"
                               class="btn btn-success btn-block"
                               href="#">
                                <i class="fas fa-plus fa-fw"></i>
                                @{{ labelCreate }}
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">

                    <div v-if="emptyResult">
                        <h5 class='text-center text-muted' colspan="12">
                            @lang('phrases.common.empty_table')
                        </h5>
                    </div>
                    <div class="row" v-else>
                        <div v-for="(item, index) in items" :key="index" class="col-md-3 col-12">
                            @include('admin.meals._partials.card')
                        </div>

                    </div>
                    @include('shared.pagination')
                </div>
            </div>
        </div>
    </template>
@endsection
