@if (count($closed_jobs) > 0)
@foreach ($closed_jobs as $item)
    <tr>
        <td>{{ $item->job_name ?? 'N/A' }}</td>
        <td>
            {{ $item->candidatePosition->name ?? 'N/A' }}
        </td>
        <td>{{ $item->duty_hours ? $item->duty_hours . ' Hours / Day' : 'N/A' }}</td>
        <td>{{ $item->contract ? $item->contract . ' Years' : 'N/A' }}</td>
        <td>{{ $item->benifits ?? 'N/A' }}</td>
        <td>
            {{ $item->quantity_of_people_required ?? 'N/A' }}
        </td>
        <td>
            @if ($item->document)
            <a href="{{ Storage::url($item->document) }}" target="_blank">
                <i class="fa-solid fa-eye"></i>
            </a>
            @endif

        </td>
        <td>{{ $item->created_at != null ? date('d M, Y', strtotime($item->created_at)) : 'N/A' }}
        </td>

        <td><a href="javascript:void(0);" class="edit-job-route"
                data-route="{{ route('company-job.edit', $item['id']) }}"><i
                    class="fas fa-edit"></i></a></td>
    </tr>
@endforeach
<tr class="toxic">
    <td colspan="8" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                (Showing {{ $closed_jobs->firstItem() }} –
                {{ $closed_jobs->lastItem() }} Jobs of
                {{ $closed_jobs->total() }} Jobs)
            </div>
            <div> {{$closed_jobs->links('vendor.pagination.bootstrap-5')}}
            </div>
        </div>
    </td>
</tr>
@else
<tr>
    <td colspan="7" class="text-center text-left">No Data Found</td>
</tr>
@endif
