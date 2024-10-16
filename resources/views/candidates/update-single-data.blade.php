
    <td class="">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input js-check-selected-row checkd-row"
                data-id="{{ $candidate['id'] }}">
        </div>
    </td>

{{-- checkbox for bulk select --}}
@can('View Candidate')
    <td class="stick-td">
        <a href="javascript:void(0);" class="edit-route" data-route="{{ route('candidates.edit', $candidate['id']) }}"><i
                class="fas fa-eye"></i></a>
    </td>
@endcan
{{-- <td>{{ $candidate->enterBy->full_name ?? 'N/A' }}</td> --}}


<td>

    <div class="round_staus" style="color: {{$candidate->candidateStatus->color ?? ''}};background: {{$candidate->candidateStatus->background ?? ''}};border: 1px solid {{$candidate->candidateStatus->color ?? ''}};">
        {{ $candidate->candidateStatus->name ?? 'N/A' }}
    </div>

</td>
<td data-bs-toggle="modal" data-bs-target="#exampleModal2" class="view-details-btn content-short"
    data-route="{{ route('candidates.activity', $candidate['id']) }}" style="cursor: pointer">
    {{-- remarks only show 10 word --}}
    @if ($candidate->lastCandidateActivity != null)
        {{ $candidate->lastCandidateActivity->call_status ?? 'N/A' }}
    @else
        {{ 'N/A' }}
    @endif
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">
    {{  date('d.m.Y', strtotime($candidate->updated_at)) }}
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->lastCandidateActivity->user->full_name ?? 'N/A' }}</td>
<td class="select-tr" data-id="{{$candidate->id}}">{{ $candidate->assign_job->interview_status ?? 'N/A' }}</td>
<td class="select-tr" data-id="{{$candidate->id}}">{{ $candidate->full_name ?? 'N/A' }}</td>
{{--  age calculation date of birth --}}
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->date_of_birth != null ? \Carbon\Carbon::parse($candidate->date_of_birth)->age : 'N/A' }}
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->indian_exp ?? 'N/A' }}</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">
    {{ $candidate->abroad_exp ?? 'N/A' }}
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->positionAppliedFor1->name ?? 'N/A' }}</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{$candidate->specialisation_1 ?? 'N/A'}}</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->positionAppliedFor2->name ?? 'N/A' }}</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{$candidate->specialisation_2 ?? 'N/A'}}</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->positionAppliedFor3->name ?? 'N/A' }}</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{$candidate->specialisation_3 ?? 'N/A'}}</td>

<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->date_of_birth != null ? date('d.m.Y', strtotime($candidate->date_of_birth)) : 'N/A' }}
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->gender ?? 'N/A' }}</td>


<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->education ?? 'N/A' }}</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->other_education ?? 'N/A' }}</td>



<td class="content-short select-tr" data-id="{{$candidate->id}}">{{ $candidate->cityName->name ?? 'N/A' }}</td>

<td class="content-short select-tr" data-id="{{$candidate->id}}">
    {{ $candidate->religion ?? 'N/A' }}
</td>
<td class=" select-tr" data-id="{{$candidate->id}}">
    @if ($candidate->candidateIndianLicence()->count() > 0)
        @foreach ($candidate->candidateIndianLicence as $key => $value)
            <span class="badge bg-primary rounded-pill">
                {{ $value->licence_name ?? 'N/A' }}
            </span>
        @endforeach
    @else
        {{ 'N/A' }}
    @endif
</td>
<td class=" select-tr" data-id="{{$candidate->id}}">
    @if ($candidate->candidateGulfLicence()->count() > 0)
        @foreach ($candidate->candidateGulfLicence as $key => $value)
            <span class="badge bg-primary rounded-pill">
                {{ $value->licence_name ?? 'N/A' }}
            </span>
        @endforeach
    @else
        {{ 'N/A' }}
    @endif
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">
    {{ $candidate->english_speak ?? 'N/A' }}
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">
    {{ $candidate->arabic_speak ?? 'N/A' }}
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">
    {{ $candidate->return == 1 ? 'YES' : 'NO' }}
</td>
<td class="content-short select-tr" data-id="{{$candidate->id}}">
    {{ $candidate->ecr_type ?? 'N/A' }}
</td>

<td data-bs-toggle="modal" data-bs-target="#exampleModal2" class="view-details-btn content-short"
    data-route="{{ route('candidates.activity', $candidate['id']) }}" style="cursor: pointer">
    {{-- remarks only show 10 word --}}
    @if ($candidate->lastCandidateActivity != null)
        @if (strlen($candidate->lastCandidateActivity->remarks) > 10)
            {{ substr($candidate->lastCandidateActivity->remarks, 0, 10) . '...' }}
        @else
            {{ $candidate->lastCandidateActivity->remarks ?? 'N/A' }}
        @endif
    @else
        {{ 'N/A' }}
    @endif
</td>
