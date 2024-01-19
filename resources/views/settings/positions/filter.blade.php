@if (count($positions) > 0)
    @foreach ($positions as $position)
        <tr>
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
        </tr>
    @endforeach
    <tr>
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $positions->firstItem() }} – {{ $positions->lastItem() }} positions of
                    {{$positions->total() }} positions)
                </div>
                <div>{!! $positions->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


