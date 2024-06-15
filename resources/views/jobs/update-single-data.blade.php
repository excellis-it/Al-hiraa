{{-- @if (Auth::user()->hasRole('ADMIN'))
    <td class="">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input js-check-selected-row checkd-row"
                data-id="{{ $candidate_job['id'] }}">
        </div>
    </td>
@endif --}}
{{-- checkbox for bulk select --}}
@can('View Job')
    <td class="stick-td">
        <a href="javascript:void(0);" class="edit-route" data-route="{{ route('jobs.edit', $candidate_job['id']) }}"><i
                class="fas fa-eye"></i></a>
    </td>
@endcan
{{-- <td>{{ $candidate->enterBy->full_name ?? 'N/A' }}</td> --}}


<td>
    <div class="round_staus active">
        {{ $candidate_job->job_status ?? 'N/A' }}
    </div>
</td>


<td class="">{{ $candidate_job->full_name ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->gender ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->date_of_birth != null ? date('d.m.Y', strtotime($candidate_job->date_of_birth)) : 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->whatapp_no ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->alternate_contact_no ?? 'N/A' }}</td>
<td class="content-short">
    @if ($candidate_job->assign_by_id != null)
        {{ $candidate_job->assignBy->first_name.' '.$candidate_job->assignBy->last_name }}
    @else
        {{ $candidate_job->assignBy ?? 'N/A' }}
    @endif
</td>
<td class="content-short">{{ $candidate_job->date_of_interview ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->date_of_selection ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->mofa_no ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->medical_application_date ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->medical_completion_date ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->medical_status ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->fst_installment_amount ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->fst_installment_date ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->secnd_installment_amount ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate_job->secnd_installment_date ?? 'N/A' }}</td>
