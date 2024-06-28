<td @can('Edit Position')  class="edit-route" data-route="{{ route('positions.edit', $position['id']) }}" @endcan>
    {{$position->user->full_name }}</td>
<td @can('Edit Position')  class="edit-route" data-route="{{ route('positions.edit', $position['id']) }}" @endcan>
    {{ $position->name }}</td>
<td @can('Edit Position')  class="edit-route" data-route="{{ route('positions.edit', $position['id']) }}" @endcan>
    @if($position->is_active == '1')
        Active
    @else
        Inactive
    @endif
</td>
@can('Delete Position')
<td>
    <a title="Delete Position" data-route="{{ route('positions.delete', Crypt::encrypt($position->id)) }}"
        href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                class="fas fa-trash"></i></span></a>
</td>
@endcan
