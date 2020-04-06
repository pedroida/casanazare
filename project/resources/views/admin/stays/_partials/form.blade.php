@csrf

<div class="form-row">
    <div class="col-12 col-md-6 offset-md-3">
        <div class="form-group">
            <label for="type">
                @lang('labels.common.type')<span class="text-danger ml-1">*</span>
            </label>
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input
                            type="radio"
                            name="type"
                            value="{{ \App\Enums\StayTypeEnum::PATIENT }}"
                            {{ old('type', $stay->type) == \App\Enums\StayTypeEnum::PATIENT ? 'checked' : '' }}
                            class="selectgroup-input">
                    <span class="selectgroup-button">
                        <i class="fas fa-user-injured"></i>
                        @lang('labels.common.' . \App\Enums\StayTypeEnum::PATIENT)
                    </span>
                </label>
                <label class="selectgroup-item">
                    <input
                            type="radio"
                            name="type"
                            value="{{ \App\Enums\StayTypeEnum::COMPANION}}"
                            {{ (old('type', $stay->type) == \App\Enums\StayTypeEnum::COMPANION) || !$stay->exists ? 'checked' : '' }}
                            class="selectgroup-input">
                    <span class="selectgroup-button">
                        <i class="fas fa-user-clock"></i>
                        @lang('labels.common.' . \App\Enums\StayTypeEnum::COMPANION)
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group floating-addon col-sm-4">
        <label for="date_of_birth">
            @lang('labels.common.client')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('client_id') }}">
            <select class="form-control select2" name="client_id" id="client_id">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}"
                            {{ old('client_id', $stay->client_id) == $client->id ? 'selected' : '' }}>
                        {{ $client->name }} - {{ $client->years_old }} anos
                    </option>
                @endforeach
            </select>
        </div>
        @errorblock('client_id')
    </div>

    <div class="form-group floating-addon col-sm-4">
        <label for="date_of_birth">
            @lang('labels.common.source')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('source_id') }}">
            <select class="form-control select2" name="source_id" id="source_id">
                @foreach($sources as $source)
                    <option value="{{ $source->id }}"
                            {{ old('source_id', $stay->source_id) == $source->id ? 'selected' : '' }}>
                        {{ $source->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @errorblock('source_id')
    </div>

    <div class="form-group floating-addon col-sm-4">
        <label for="date_of_birth">
            @lang('labels.common.responsible')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('responsible_id') }}">
            <select class="form-control select2" name="responsible_id" id="responsible_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                            {{ old('responsible_id', $stay->responsible_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @errorblock('responsible_id')
    </div>

</div>

<div class="form-row">
    <div class="form-group floating-addon col-sm-4">
        <label for="date_of_birth">
            @lang('labels.common.entry_date')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('entry_date') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>

            <datepicker
                    name="entry_date"
                    :language="ptBr"
                    input-class="form-control"
                    wrapper-class="w-100"
                    format="dd/MM/yyyy"
                    :value="new Date('{{ format_date($stay->entry_date ?? now(), 'Y,m,d') }}')">
            </datepicker>
        </div>
        @errorblock('entry_date')
    </div>

    <div class="form-group floating-addon col-sm-4">
        <label for="date_of_birth">
            @lang('labels.common.departure_date')
        </label>
        <div class="input-group {{ has_error_class('departure_date') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>

            <datepicker
                    name="departure_date"
                    :language="ptBr"
                    input-class="form-control"
                    wrapper-class="w-100"
                    @if($stay->departure_date)
                    :value="new Date('{{ format_date($stay->departure_date, 'Y,m,d') }}')"
                    @endif
                    format="dd/MM/yyyy">
            </datepicker>
        </div>
        @errorblock('departure_date')
    </div>

    <div class="form-group floating-addon col-sm-4">
        <label for="comments">
            @lang('labels.common.comments')
        </label>
        <div class="input-group {{ has_error_class('comments') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-comment-dots"></i>
                </span>
            </div>

            <input type="text" class="form-control" name="comments" id="comments"
                   value="{{ old('comments', $stay->comments) }}">
        </div>
        @errorblock('comments')
    </div>

</div>
