@csrf

<div class="form-row">
    <div class="form-group floating-addon col-sm-4">
        <label for="name">
            @lang('labels.common.name')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('name') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-user"></i>
                </span>
            </div>
            <input type="text" name="name" class="form-control {{ has_error_class('name') }}"
                   placeholder="@lang('placeholders.users.name')"
                   value="{{ old('name', $client->name ?? '') }}" autofocus>
        </div>
        @errorblock('name')
    </div>

    <div class="form-group floating-addon col-sm-4">
        <label for="rg">
            @lang('labels.common.rg')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('rg') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-id-card"></i>
                </span>
            </div>
            <input type="text" name="rg" class="form-control mask-rg {{ has_error_class('rg') }}"
                   placeholder="@lang('placeholders.users.rg')"
                   value="{{ old('rg', $client->rg ?? '') }}" autofocus>
        </div>
        @errorblock('rg')
    </div>

    <div class="form-group floating-addon col-sm-4">
        <label for="date_of_birth">
            @lang('labels.common.date_of_birth')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('date_of_birth') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-birthday-cake"></i>
                </span>
            </div>

            <datepicker
                    name="date_of_birth"
                    :language="ptBr"
                    input-class="form-control"
                    wrapper-class="w-100"
                    format="dd/MM/yyyy"
                    :value="new Date('{{ format_date($client->date_of_birth ?? now(), 'Y/m/d') }}')">
            </datepicker>
        </div>
        @errorblock('date_of_birth')
    </div>

</div>

<div class="form-row">
    <div class="form-group floating-addon col-sm-3">
        <label for="phone_one">
            @lang('labels.common.phone_one')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('phone_one') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
            <input type="text" name="phone_one" class="form-control mask-cellphone {{ has_error_class('phone_one') }}"
                   placeholder="@lang('placeholders.common.phone')"
                   value="{{ old('phone_one', $client->phone_one ?? '') }}" autofocus>
        </div>
        @errorblock('phone_one')
    </div>

    <div class="form-group floating-addon col-sm-3">
        <label for="phone_two">
            @lang('labels.common.phone_two')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('phone_two') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
            <input type="text" name="phone_two" class="form-control mask-cellphone {{ has_error_class('phone_two') }}"
                   placeholder="@lang('placeholders.common.phone')"
                   value="{{ old('phone_two', $client->phone_two ?? '') }}" autofocus>
        </div>
        @errorblock('phone_two')
    </div>

    <div class="col-6">
        <address-component
                :is-admin='@json(current_user()->hasRole(\App\Enums\UserRolesEnum::ADMIN))'
                :resource='@json($client)'
                :errors-bag="{{ $errors }}"
                :old='{{ json_encode(old()) }}'>

        </address-component>
    </div>
</div>
