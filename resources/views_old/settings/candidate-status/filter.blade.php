@if (count($statuses) > 0)
    @foreach ($statuses as $status)
        <tr>
            <td>
                {{ $loop->iteration + $statuses->firstItem() - 1 }}
            </td>
            <td class="edit-route" data-route="{{ route('status.edit', $status['id']) }}">
                {{ $status->name }}</td>
            {{-- <td class="edit-route" data-route="{{ route('status.edit', $status['id']) }}">{{ $status->color }}</td>
            <td class="edit-route" data-route="{{ route('status.edit', $status['id']) }}">{{ $status->background }}</td> --}}

            <td>
                <a title="Delete status" data-route="{{ route('status.delete', Crypt::encrypt($status->id)) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="3" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $statuses->firstItem() }} – {{ $statuses->lastItem() }} statuses of
                    {{$statuses->total() }} statuses)
                </div>
                <div>{!! $statuses->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="3" class="text-center">No Data Found</td>
    </tr>
@endif


