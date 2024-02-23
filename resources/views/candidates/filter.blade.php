@if (count($candidates) > 0)
    @foreach ($candidates as $item)

        <tr @if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) @else
        class="{{ $item->is_call_id != null ? 'disabled-row' : '' }}" id="candidate-{{ $item['id'] }}" @endif>
            {{-- checkbox for bulk select --}}
            @if (Auth::user()->hasRole('ADMIN'))
            <td class="">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input js-check-selected-row checkd-row"  data-id="{{$item['id']}}">
                </div>
            </td>
            @endif
            {{-- checkbox for bulk select --}}
            @can('View Candidate')
                <td class="stick-td">
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
            <td data-bs-toggle="modal" data-bs-target="#exampleModal2" class="view-details-btn content-short"
                data-route="{{ route('candidates.activity', $item['id']) }}" style="cursor: pointer">
                {{-- remarks only show 10 word --}}
                @if ($item->lastCandidateActivity != null)
                    {{ $item->lastCandidateActivity->call_status ?? 'N/A' }}
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td class="content-short">{{ $item->candidateUpdate()->count() > 0 ? date('d.m.Y', strtotime($item->candidateUpdate->created_at)) : date('d.m.Y', strtotime($item->updated_at)) }}
            </td>
            <td class="content-short">{{ $item->candidateUpdate->user->full_name ?? 'N/A' }}</td>

            <td class="">{{ $item->full_name ?? 'N/A' }}</td>
            <td class="content-short">{{ $item->gender ?? 'N/A' }}</td>
            <td class="content-short">{{ $item->date_of_birth != null ? date('d.m.Y', strtotime($item->date_of_birth)) : 'N/A' }}</td>
            {{--  age calculation date of birth --}}
            <td class="content-short">{{ $item->date_of_birth != null ? \Carbon\Carbon::parse($item->date_of_birth)->age : 'N/A' }}</td>
            <td class="content-short">{{ $item->education ?? 'N/A' }}</td>
            <td class="content-short">{{ $item->other_education ?? 'N/A' }}</td>
            <td class="content-short">
                {{ $item->indian_exp ?? 'N/A' }}
            </td>
            <td class="content-short">
                {{ $item->abroad_exp ?? 'N/A' }}
            </td>
            <td class="content-short">{{ $item->positionAppliedFor1->name ?? 'N/A' }}</td>
            <td class="content-short">{{ $item->positionAppliedFor2->name ?? 'N/A' }}</td>
            <td class="content-short">{{ $item->positionAppliedFor3->name ?? 'N/A' }}</td>
            <td class="content-short">{{ $item->passport_number ?? 'N/A' }}</td>
            <td class="content-short">{{ $item->mode_of_registration ?? 'N/A' }}</td>
            <td class="content-short">
                {{ $item->source ?? 'N/A' }}
            </td>
            <td class="content-short">
                {{ $item->city ?? 'N/A' }}
            </td>
            <td class="content-short">
                @if ($item->referred_by_id != null)
                    {{ $item->referredBy->full_name }}
                @else
                    {{ $item->referred_by ?? 'N/A' }}
                @endif
            </td>
            <td class="content-short">
                {{ $item->religion ?? 'N/A' }}
            </td>
            <td class="">
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
            <td class="">
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
            <td class="content-short">
                {{ $item->english_speak ?? 'N/A' }}
            </td>
            <td class="content-short">
                {{ $item->arabic_speak ?? 'N/A' }}
            </td>
            <td class="content-short">
                {{ $item->return == 1 ? 'YES' : 'NO' }}
            </td>
            <td class="content-short">
                {{ $item->ecr_type ?? 'N/A' }}
            </td>

            <td data-bs-toggle="modal" data-bs-target="#exampleModal2" class="view-details-btn content-short"
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
    <tr class="toxic">
        <td colspan="30" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $candidates->links() !!}
                </div>
                <div>(Showing {{ $candidates->firstItem() }} – {{ $candidates->lastItem() }} candidates of
                    {{ $candidates->total() }} candidates)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="30" class="text-center">No Data Found</td>
    </tr>
@endif
