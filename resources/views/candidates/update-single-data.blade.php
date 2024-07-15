@if (Auth::user()->hasRole('ADMIN'))
    <td class="">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input js-check-selected-row checkd-row"
                data-id="{{ $candidate['id'] }}">
        </div>
    </td>
@endif
{{-- checkbox for bulk select --}}
@can('View Candidate')
    <td class="stick-td">
        <a href="javascript:void(0);" class="edit-route" data-route="{{ route('candidates.edit', $candidate['id']) }}"><i
                class="fas fa-eye"></i></a>
    </td>
@endcan
{{-- <td>{{ $candidate->enterBy->full_name ?? 'N/A' }}</td> --}}


<td>
   
    <div class="round_staus" style="color: {{$candidate->candidateStatus->color}};background: {{$candidate->candidateStatus->background}};border: 1px solid {{$candidate->candidateStatus->color}};">
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
<td class="content-short">
    {{ $candidate->candidateUpdate()->count() > 0 ? date('d.m.Y', strtotime($candidate->candidateUpdate->created_at)) : date('d.m.Y', strtotime($candidate->updated_at)) }}
</td>
<td class="content-short">{{ $candidate->candidateUpdate->user->full_name ?? 'N/A' }}</td>

<td class="">{{ $candidate->full_name ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->gender ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->date_of_birth != null ? date('d.m.Y', strtotime($candidate->date_of_birth)) : 'N/A' }}
</td>
{{--  age calculation date of birth --}}
<td class="content-short">{{ $candidate->date_of_birth != null ? \Carbon\Carbon::parse($candidate->date_of_birth)->age : 'N/A' }}
</td>
<td class="content-short">{{ $candidate->education ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->other_education ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->indian_exp ?? 'N/A' }}</td>
<td class="content-short">
    {{ $candidate->abroad_exp ?? 'N/A' }}
</td>
<td class="content-short">{{ $candidate->positionAppliedFor1->name ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->positionAppliedFor2->name ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->positionAppliedFor3->name ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->passport_number ?? 'N/A' }}</td>
<td class="content-short">{{ $candidate->cityName->name ?? 'N/A' }}</td>
<td class="content-short">
    @if ($candidate->referred_by_id != null)
        {{ $candidate->referredBy->full_name }}
    @else
        {{ $candidate->referred_by ?? 'N/A' }}
    @endif
</td>
<td class="content-short">{{ $candidate->mode_of_registration ?? 'N/A' }}</td>
<td class="content-short">
    {{ $candidate->source ?? 'N/A' }}
</td>

<td class="content-short">
    {{ $candidate->religion ?? 'N/A' }}
</td>
<td class="">
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
<td class="">
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
<td class="content-short">
    {{ $candidate->english_speak ?? 'N/A' }}
</td>
<td class="content-short">
    {{ $candidate->arabic_speak ?? 'N/A' }}
</td>
<td class="content-short">
    {{ $candidate->return == 1 ? 'YES' : 'NO' }}
</td>
<td class="content-short">
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
