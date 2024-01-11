@if (count($candidates) > 0)
    @foreach ($candidates as $item)
        <tr @can('Edit Candidate') class="edit-route" data-route="{{ route('candidates.edit', $item['id']) }}" @endcan>
            <td>{{ $item->remarks ?? 'N/A' }}</td>
            <td>{{ $item->enterBy->full_name ?? 'N/A' }}</td>
            <td>
                <div class="round_staus active">
                    {{ $item->candidateStatus->name ?? 'N/A' }}
                </div>
            </td>
            <td>{{ $item->mode_of_registration ?? 'N/A' }}</td>
            <td>
                {{ $item->source ?? 'N/A' }}
            </td>
            <td>{{ $item->last_update_date != null ? date('d.m.Y', strtotime($item->last_update_date)) : 'N/A' }}</td>
            <td>{{ $item->full_name ?? 'N/A' }}</td>
            <td>{{ $item->gender ?? 'N/A' }}</td>
            <td>{{ $item->date_of_birth != null ? date('d.m.Y', strtotime($item->date_of_birth)) : 'N/A' }}</td>
            <td>{{ $item->age ?? 'N/A' }}</td>
            <td>{{ $item->education ?? 'N/A' }}</td>
            <td>*************</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="12" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    (Showing {{ $candidates->firstItem() }} – {{ $candidates->lastItem() }} candidates of
                    {{ $candidates->total() }} candidates)
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
