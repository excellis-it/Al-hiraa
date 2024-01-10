@if (count($candidates) > 0)
@foreach ($candidates as $item)
    <tr data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">
        <td>{{ $item->remarks }}</td>
        <td>{{ $item->enterBy->full_name }}</td>
        <td>
            <div class="round_staus active">
                {{ $item->candidateStatus->name }}
            </div>
        </td>
        <td>{{ $item->mode_of_registration }}</td>
        <td>
            {{ $item->source }}
        </td>
        <td>{{ date('d.m.Y', strtotime($item->last_update_date)) }}</td>
        <td>{{ $item->full_name }}</td>
        <td>{{ $item->gender }}</td>
        <td>{{ date('d.m.Y', strtotime($item->date_of_birth)) }}</td>
        <td>{{ $item->age }}</td>
        <td>{{ $item->education }}</td>
        <td>*************</td>
    </tr>
@endforeach
<tr>
    <td colspan="12" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                 (Showing {{ $candidates->firstItem() }} – {{ $candidates->lastItem() }} candidates of
                {{$candidates->total() }} candidates)
            </div>
            <div>{!! $candidates->links() !!}</div>
        </div>
    </td>
</tr>
@else
<tr>
    <td colspan="12" class="text-center">No Data Found</td>
</tr>
@endif
