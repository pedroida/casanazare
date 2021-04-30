<tr>
  <th>
    @lang('labels.common.name')
  </th>
  <th>
    @lang('labels.common.source')
  </th>
  <th>
    @lang('labels.common.responsible')
  </th>
  <th>
    @lang('labels.common.type')
  </th>
  <th sortable @click="orderBy('entry_date', $event)">
    @lang('labels.common.entry_date')
  </th>
  <th sortable @click="orderBy('departure_date', $event)">
    @lang('labels.common.departure_date')
  </th>
  <th sortable @click="orderBy('created_at', $event)">
    @lang('labels.common.created_at')
  </th>
  <th class="text-center" style='width: 15%'>
    @lang('labels.common.actions')
  </th>
</tr>
