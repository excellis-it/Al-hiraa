@if (count($candidates) > 0)
    @foreach ($candidates as $item)

        <tr @if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) @else
        class="{{ $item->is_call_id != null ? 'disabled-row' : '' }}" @endif
            id="candidate-{{ $item['id'] }}">
            {{-- checkbox for bulk select --}}
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input js-check-selected-row">
                </div>
            </td>

            @can('View Candidate')
                <td>
                    <a href="javascript:void(0);" class="edit-route"
                        data-route="{{ route('candidates.edit', $item['id']) }}"><i class="fas fa-eye"></i></a>
                </td>
            @endcan
            {{-- <td>{{ $item->enterBy->full_name ?? 'N/A' }}</td> --}}


            <td>
                <div class="round_staus active">
                    {{ $item->candidateStatus->name ?? 'N/A' }}
                </div>
            </td>
            <td data-bs-toggle="modal" data-bs-target="#exampleModal2" class="view-details-btn"
                data-route="{{ route('candidates.activity', $item['id']) }}" style="cursor: pointer">
                {{-- remarks only show 10 word --}}
                @if ($item->lastCandidateActivity != null)
                    {{ $item->lastCandidateActivity->call_status ?? 'N/A' }}
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>{{ $item->candidateUpdate()->count() > 0 ? date('d.m.Y', strtotime($item->candidateUpdate->created_at)) : 'N/A' }}
            </td>
            <td>{{ $item->candidateUpdate->user->full_name ?? 'N/A' }}</td>
            <td>{{ $item->mode_of_registration ?? 'N/A' }}</td>
            <td>
                {{ $item->source ?? 'N/A' }}
            </td>
            <td>{{ $item->full_name ?? 'N/A' }}</td>
            <td>{{ $item->gender ?? 'N/A' }}</td>
            <td>{{ $item->date_of_birth != null ? date('d.m.Y', strtotime($item->date_of_birth)) : 'N/A' }}</td>
            {{--  age calculation date of birth --}}
            <td>{{ $item->date_of_birth != null ? \Carbon\Carbon::parse($item->date_of_birth)->age : 'N/A' }}</td>
            <td>{{ $item->education ?? 'N/A' }}</td>
            <td>{{ $item->other_education ?? 'N/A' }}</td>
            <td>{{ $item->positionAppliedFor1->name ?? 'N/A' }}</td>
            <td>{{ $item->positionAppliedFor2->name ?? 'N/A' }}</td>
            <td>{{ $item->positionAppliedFor3->name ?? 'N/A' }}</td>
            <td>{{ $item->passport_number ?? 'N/A' }}</td>
            <td>
                {{ $item->city ?? 'N/A' }}
            </td>
            <td>
                @if ($item->referred_by_id != null)
                    {{ $item->referredBy->full_name }}
                @else
                    {{ $item->referred_by ?? 'N/A' }}
                @endif
            </td>
            <td>
                {{ $item->religion ?? 'N/A' }}
            </td>
            <td>
                @if ($item->candidateIndianLicence()->count() > 0)
                    @foreach ($item->candidateIndianLicence as $key => $value)
                        <span class="badge bg-primary rounded-pill">
                            {{ $value->licence_name ?? 'N/A' }}
                        </span>
                    @endforeach
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>
                @if ($item->candidateGulfLicence()->count() > 0)
                    @foreach ($item->candidateGulfLicence as $key => $value)
                        <span class="badge bg-primary rounded-pill">
                            {{ $value->licence_name ?? 'N/A' }}
                        </span>
                    @endforeach
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>
                {{ $item->english_speak ?? 'N/A' }}
            </td>
            <td>
                {{ $item->arabic_speak ?? 'N/A' }}
            </td>
            <td>
                {{ $item->return == 1 ? 'Yes' : 'No' }}
            </td>
            <td>
                {{ $item->ecr_type ?? 'N/A' }}
            </td>
            <td>
                {{ $item->indian_exp ?? 'N/A' }}
            </td>
            <td>
                {{ $item->abroad_exp ?? 'N/A' }}
            </td>
            <td data-bs-toggle="modal" data-bs-target="#exampleModal2" class="view-details-btn"
            data-route="{{ route('candidates.activity', $item['id']) }}" style="cursor: pointer">
            {{-- remarks only show 10 word --}}
            @if ($item->lastCandidateActivity != null)
                @if (strlen($item->lastCandidateActivity->remarks) > 10)
                    {{ substr($item->lastCandidateActivity->remarks, 0, 10) . '...' }}
                @else
                    {{ $item->lastCandidateActivity->remarks ?? 'N/A' }}
                @endif
            @else
                {{ 'N/A' }}
            @endif
        </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="30" class="text-left">
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
        <td colspan="30" class="text-center">No Data Found</td>
    </tr>
@endif
