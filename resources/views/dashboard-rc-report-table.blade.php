@if (count($recruiters) > 0)
    @foreach ($recruiters as $recruiter)
        <tr>
            <td>{{ $recruiter->first_name }} {{ $recruiter->last_name }}</td>
            <!-- Adjust if recruiter name is under a different field -->
            <td>{{ $recruiter->candidate_added_count }}</td>
            <td>{{ $recruiter->candidate_data_view_count }}</td>
            <td>{{ $recruiter->interested_job_count }}</td>
            <td>{{ $recruiter->selected_job_count }}</td>
            <td>{{ $recruiter->deployed_job_count }}</td>

        </tr>
    @endforeach

    <tr>
        <td colspan="5" class="text-left">
            <div class="d-flex justify-content-between">
                <div>
                    (Showing {{ $recruiters->firstItem() }} – {{ $recruiters->lastItem() }} users of
                    {{ $recruiters->total() }} recruiters)
                </div>
                <div>
                    {!! $recruiters->appends(request()->except('recruiters_page'))->links() !!}
                </div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="5" class="text-center">No data found</td>
    </tr>
@endif
