<td>@{{ item.name }}</td>
<td>@{{ item.rg }}</td>
<td>@{{ item.phone_one }}</td>
<td>@{{ item.date_of_birth }}</td>
<td>@{{ item.created_at }}</td>
<td class="text-center">
    <div class="btn-group" v-if="item.links">

        <a v-if="item.links.show" :href="item.links.show"
           class="btn btn-sm btn-primary"
           title="@lang('buttons.common.show')"
           data-toggle="tooltip"
           data-placement="top"
           role="button">
            <i class="fas fa-eye"></i>
        </a>

        <a v-if="item.links.edit" :href="item.links.edit"
           class="btn btn-sm btn-warning"
           title="@lang('buttons.common.edit')"
           data-toggle="tooltip"
           data-placement="top"
           role="button">
            <i class="fas fa-pencil-alt"></i>
        </a>

        <a v-if="item.links.forbid" @click.prevent="confirm(item.links.forbid)"
           class="btn btn-sm btn-outline-danger"
           title="@lang('buttons.common.forbid')"
           data-toggle="tooltip"
           data-placement="top"
           role="button">
            <i class="fas fa-exclamation-circle "></i>
        </a>

        <a v-if="item.links.allow" @click.prevent="confirm(item.links.allow)"
           class="btn btn-sm btn-success"
           title="@lang('buttons.common.allow')"
           data-toggle="tooltip"
           data-placement="top"
           role="button">
            <i class="fas fa-check-circle text-white"></i>
        </a>

        <a v-if="item.links.destroy" @click.prevent="confirmDelete(item.links.destroy)"
           class="btn btn-sm btn-danger"
           title="@lang('buttons.common.destroy')"
           data-toggle="tooltip"
           data-placement="top"
           role="button">
            <i class="fas fa-trash-alt text-white"></i>
        </a>
    </div>
</td>
