<div class="pricing card-hover border-success">
    <div class="pt-3">
        <div class="pricing-price">
            <div>@{{ item.day_formatted }}</div>
            <div>@{{ item.week_day }}</div>
        </div>
        <div class="pricing-details">
            <div class="pricing-item">
                <div class="pricing-item-icon"><i class="fas fa-coffee"></i></div>
                <div class="pricing-item-label">@{{ item.breakfasts }} Cafés da manhã</div>
            </div>

            <div class="pricing-item">
                <div class="pricing-item-icon"><i class="fas fa-utensils"></i></div>
                <div class="pricing-item-label">@{{ item.lunches }} Almoços</div>
            </div>

            <div class="pricing-item">
                <div class="pricing-item-icon"><i class="fas fa-utensil-spoon"></i></div>
                <div class="pricing-item-label">@{{ item.dinners }} Jantas</div>
            </div>
        </div>
    </div>
    <div class="pricing-cta">
        <a href="#" class="bg-warning text-white" @click="$root.$emit('editMeal', item)">
            @lang('links.common.edit')
            <i class="fas fa-pencil-alt text-white"></i>
        </a>
    </div>
</div>
