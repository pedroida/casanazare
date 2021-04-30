@extends('layouts.app')
@section('title', __('headings.clients.show'))

@section('page-header')
    <h1>
        <i class="fas fa-user-alt fa-fw mr-2 text-muted"></i>
        @lang('headings.clients.show')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('admin.acolhidos.index') }}">
            @lang('breadcrumb.clients.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.show')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
    <div class="card card-secondary">
        <div class="card-body pb-0">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label>@lang('labels.common.name')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-user"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control" value="{{ $client->name ?? '' }}" disabled>
                    </div>
                </div>

                <div class="form-group col-sm-4">
                    <label>@lang('labels.common.rg')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-id-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ $client->rg }}" disabled>
                    </div>
                </div>

                <div class="form-group col-sm-4">
                    <label>@lang('labels.common.date_of_birth')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-birthday-cake"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ format_date($client->date_of_birth, 'd/m/Y') }}" disabled>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label>@lang('labels.common.phone_one')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control" value="{{ $client->phone_one ?? '' }}" disabled>
                    </div>
                </div>

                <div class="form-group col-sm-4">
                    <label>@lang('labels.common.phone_two')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control" value="{{ $client->phone_two ?? '' }}" disabled>
                    </div>
                </div>

                <div class="form-group col-sm-4">
                    <label>@lang('labels.common.city-state')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ ($client->city) ? "{$client->city->name}/{$client->city->state->name}" : 'Não informado' }}" disabled>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label>@lang('labels.common.created_at')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control" value="{{ format_date($client->created_at) ?? '' }}"
                               disabled>
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label>@lang('labels.common.updated_at')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control" value="{{ format_date($client->updated_at) ?? '' }}"
                               disabled>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                @include('shared.show_buttons', [
                    'urlBack' => route('voluntary.acolhidos.index'),
                    'urlEdit' => route('voluntary.acolhidos.edit', $client->id)
                ])
            </div>
        </div>
    </div>
@endsection
