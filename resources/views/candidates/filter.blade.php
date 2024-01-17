@if (count($candidates) > 0)
    @foreach ($candidates as $item)
        <tr @can('View Candidate') class="edit-route" data-route="{{ route('candidates.edit', $item['id']) }}" @endcan>
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
            <td>{{ $item->updated_at != null ? date('d.m.Y', strtotime($item->updated_at)) : 'N/A' }}</td>
            <td>{{ $item->full_name ?? 'N/A' }}</td>
            <td>{{ $item->gender ?? 'N/A' }}</td>
            <td>{{ $item->date_of_birth != null ? date('d.m.Y', strtotime($item->date_of_birth)) : 'N/A' }}</td>
            {{--  age calculation date of birth --}}
            <td>{{  $item->date_of_birth != null ? \Carbon\Carbon::parse($item->date_of_birth)->age : 'N/A' }}</td>
            <td>{{ $item->education ?? 'N/A' }}</td>
            <td>{{ $item->position_applied_for_1 ?? 'N/A' }}</td>
            <td>{{ $item->position_applied_for_2 ?? 'N/A' }}</td>
            <td>{{ $item->position_applied_for_3 ?? 'N/A' }}</td>
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
