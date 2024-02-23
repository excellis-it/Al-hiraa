@if (count($ongoing_jobs) > 0)
    @foreach ($ongoing_jobs as $item)
        <tr>
            <td>{{ $item->job_name ?? 'N/A' }}</td>
            <td> {{ $item->candidatePosition->name ?? 'N/A' }}</td>
            <td>{{ $item->duty_hours ? $item->duty_hours . ' Hours / Day' : 'N/A' }}</td>
            <td>{{ $item->contract ? $item->contract . ' Years' : 'N/A' }}</td>
            <td>{{ $item->benifits ?? 'N/A' }}</td>
            <td>{{ $item->city->name ?? 'N/A' }}</td>
            <td>{{ $item->state->name ?? 'N/A' }}</td>
            <td>{{ $item->created_at != null ? date('d M, Y', strtotime($item->created_at)) : 'N/A' }}
            </td>
            <td><a href="javascript:void(0);" class="edit-job-route"
                    data-route="{{ route('company-job.edit', $item['id']) }}"><i class="fas fa-edit"></i></a></td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="8" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    (Showing {{ $ongoing_jobs->firstItem() }} –
                    {{ $ongoing_jobs->lastItem() }} Jobs of
                    {{ $ongoing_jobs->total() }} Jobs)
                </div>
                <div>{{$ongoing_jobs->links('vendor.pagination.bootstrap-4')}}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="6" class="text-center">No Data Found</td>
    </tr>
@endif
