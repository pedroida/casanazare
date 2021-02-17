<tr>
    <th sortable @click="orderBy('name', $event)">
        @lang('labels.common.name')
    </th>

    <th sortable @click="orderBy('quantity', $event)">
        @lang('labels.common.quantity')
    </th>

    <th>
        @lang('labels.common.unit')
    </th>

    <th>
        @lang('labels.common.category')
    </th>

    <th sortable @click="orderBy('validate', $event)">
        @lang('labels.common.validate')
    </th>

    <th sortable @click="orderBy('created_at', $event)">
        @lang('labels.common.created_at')
    </th>
    <th class="text-center" style="width: 15%">
        @lang('labels.common.actions')
    </th>
</tr>
