@if (count($associates) > 0)
@foreach ($associates as $associate)
<tr>
    <td class="edit-route" data-route="{{ route('associates.edit', $associate->id) }}">
        {{ $associate->associate_id }}
    </td>
    <td class="edit-route" data-route="{{ route('associates.edit', $associate->id) }}">
        {{ $associate->name }}
    </td>
    <td class="edit-route" data-route="{{ route('associates.edit', $associate->id) }}">
        {{ $associate->phone_number }}
    </td>
    <td class="edit-route" data-route="{{ route('associates.edit', $associate->id) }}">
        {{ date('d/m/Y', strtotime($associate->created_at)) }}
    </td>
    {{-- <td>
        <a title="Delete Associate" data-route="{{ route('associates.delete', $associate->id) }}"
            href="javascript:void(0);" id="delete">
            <span class="trash-icon"><i class="fas fa-trash"></i></span>
        </a>
    </td> --}}
</tr>
@endforeach
<tr class="toxic">
    <td colspan="5" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                (Showing {{ $associates->firstItem() }} – {{ $associates->lastItem() }} associates of
                {{ $associates->total() }} associates)
            </div>
            <div>{!! $associates->links() !!}</div>
        </div>
    </td>
</tr>
@else
<tr>
    <td colspan="5" class="text-center">No Data Found</td>
</tr>
@endif
