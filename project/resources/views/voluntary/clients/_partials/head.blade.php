<tr>
  <th sortable @click="orderBy('name', $event)">
    @lang('labels.common.name')
  </th>
  <th sortable @click="orderBy('rg', $event)">
    @lang('labels.common.rg')
  </th>
  <th sortable @click="orderBy('phone_one', $event)">
    @lang('labels.common.phone_one')
  </th>
  <th sortable @click="orderBy('date_of_birth', $event)">
    @lang('labels.common.date_of_birth')
  </th>
  <th sortable @click="orderBy('created_at', $event)">
    @lang('labels.common.created_at')
  </th>
  <th class="text-center" style='width: 15%'>
    @lang('labels.common.actions')
  </th>
</tr>