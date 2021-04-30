@csrf

<div class="form-row">
    <div class="form-group col-12 col-md-6">
        <label for="name">
            @lang('labels.common.name')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('name') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-box-open"></i>
                </span>
            </div>
            <input type="text" name="name" class="form-control {{ has_error_class('name') }}"
                   placeholder="@lang('placeholders.donations.name')"
                   value="{{ old('name', $donation->name ?? '') }}" autofocus>
        </div>
        @errorblock('name')
    </div>

    <div class="form-group col-12 col-md-2">
        <label for="quantity">
            @lang('labels.common.quantity')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('quantity') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-sort-numeric-up-alt"></i>
                </span>
            </div>
            <input type="text" name="quantity" class="form-control mask-quantity {{ has_error_class('quantity') }}"
                   placeholder="@lang('placeholders.donations.quantity')"
                   value="{{ old('quantity', $donation->formatted_quantity ?? '1,000') }}">
        </div>
        @errorblock('quantity')
    </div>

    <div class="form-group floating-addon col-12 col-md-4">
        <label for="validate">
            @lang('labels.common.validate')
        </label>
        <div class="input-group {{ has_error_class('validate') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>

            <datepicker
                    name="validate"
                    :language="ptBr"
                    input-class="form-control"
                    wrapper-class="w-100"
                    @if($donation->validate)
                    :value="new Date('{{ format_date($donation->validate, 'Y,m,d') }}')"
                    @endif
                    format="dd/MM/yyyy">
            </datepicker>
        </div>
        @errorblock('validate')
    </div>

</div>

<div class="form-row">
    <div class="form-group col-12 col-md-6">
        <label for="donation_unit_id">
            @lang('labels.common.unit')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('donation_unit_id') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-ruler-vertical"></i>
                </span>
            </div>
            <select name="donation_unit_id" id="donation_unit_id" class="form-control select2 {{ has_error_class('donation_unit_id') }}">
                @foreach($units as $unit)
                    <option
                            value="{{ $unit->id }}"
                            {{ old('donation_unit_id', $donation->donation_unit_id) == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @errorblock('donation_unit_id')
    </div>

    <div class="form-group col-12 col-md-6 p-md-0">
        <label for="donation_category_id">
            @lang('labels.common.category')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('donation_category_id') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-ruler-vertical"></i>
                </span>
            </div>
            <select name="donation_category_id" id="donation_category_id"
                    class="form-control select2 {{ has_error_class('donation_category_id') }}">
                @foreach($categories as $category)
                    <option
                            value="{{ $category->id }}"
                            {{ old('donation_category_id', $donation->donation_category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @errorblock('donation_category_id')
    </div>

</div>
