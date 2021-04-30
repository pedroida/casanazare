<td>@{{ item.client_name }}</td>
<td>@{{ item.source_name }}</td>
<td>@{{ item.responsible_name }}</td>
<td>@{{ item.type }}</td>
<td>@{{ item.entry_date }}</td>
<td class="text-center">@{{ item.departure_date ?? '-' }}</td>
<td>@{{ item.created_at }}</td>
<td class="text-center">
    @include('shared.buttons_actions')
</td>
