@if (count($candidate_jobs) > 0)
    @foreach ($candidate_jobs as $candidate_job)
        <tr @if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) class="candidate-new-{{ $candidate_job['id'] }}" @else
        class="{{ $candidate_job->is_call_id != null ? 'disabled-row' : '' }} candidate-new-{{ $candidate_job['id'] }}" id="candidate-{{ $candidate_job['id'] }}" @endif
            data-id="{{ $candidate_job['id'] }}">
            @include('jobs.update-single-data', ['candidate_job' => $candidate_job])
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="30" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $candidate_jobs->links() !!}
                </div>
                <div>(Showing {{ $candidate_jobs->firstItem() }} – {{ $candidate_jobs->lastItem() }} candidate jobs of
                    {{ $candidate_jobs->total() }} candidate jobs)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="30" class="text-center">No Data Found</td>
    </tr>
@endif
