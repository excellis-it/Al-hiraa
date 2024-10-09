

@if (count($recruiters) > 0)

@foreach($recruiters as $recruiter)
<tr>
    <td>{{ $recruiter->first_name }} {{ $recruiter->last_name }}</td> <!-- Adjust if recruiter name is under a different field -->
    <td>{{ $recruiter->interested_job_count }}</td>
    <td>{{ $recruiter->selected_job_count }}</td>
    <td>{{ $recruiter->deployed_job_count }}</td>
    <td>{{ $recruiter->candidate_added_count }}</td>
</tr>
@endforeach

    <tr>
        <td colspan="5" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    (Showing {{ $recruiters->firstItem() }} – {{ $recruiters->lastItem() }} users of
                    {{ $recruiters->total() }} users)
                </div>
                <div>{!! $recruiters->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="5" class="text-center">No data found</td>
    </tr>
@endif
