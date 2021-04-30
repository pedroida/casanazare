@csrf

<div class="form-row">
    <div class="form-group col-sm-12">
        <label for="name">
            @lang('labels.common.name')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('name') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-ruler-vertical"></i>
                </span>
            </div>
            <input type="text" name="name" class="form-control {{ has_error_class('name') }}"
                placeholder="@lang('placeholders.units.name')"
                value="{{ old('name', $unit->name ?? '') }}" autofocus>
        </div>
        @errorblock('name')
    </div>

</div>
