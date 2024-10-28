<table class="table mb-0 table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Remarks</th>
            <th>Enter By</th>
            <th>Status</th>
            <th>Mode of Registration</th>
            <th>Source</th>
            <th>Last Update Date</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Education</th>
            <th>Contact No:</th>
            <th>Alternate Contact No.</th>
            <th>Whatsapp No.</th>
            <th>Email ID</th>
            <th>Referred By</th>
            <th>Associate By</th>
            <th>Other Education</th>
            <th>State</th>
            <th>City</th>
            <th>Religion</th>
            <th>ECR Type</th>
            <th>Indian Driving License </th>
            <th>Gulf Driving License </th>
            <th>English Speak</th>
            <th>Arabic Speak</th>
            <th>Return</th>
            <th>Position Applied For(1)</th>
            <th>Position Applied For(2)</th>
            <th>Position Applied For(3)</th>
            <th>
                Passport Number
            </th>
            <th>Indian Experience (If any?)</th>
            <th>Abroad Experience (If any?)</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody class="list" id="candidate_body">
        @foreach ($candidates as $item)
            <tr>
                <td>{{ date('d.m.Y', strtotime($item->created_at)) ?? 'N/A' }}</td>
                <td>
                    @if ($item->lastCandidateActivity != null)
                        {{ $item->lastCandidateActivity->remarks ?? 'N/A' }}
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>{{ $item->enterBy->full_name ?? 'N/A' }}</td>
                <td>
                    <div class="round_staus active">
                        {{ $item->candidateStatus->name ?? 'N/A' }}
                    </div>
                </td>
                <td>{{ $item->mode_of_registration ?? 'N/A' }}</td>
                <td>
                    {{ $item->source ?? 'N/A' }}
                </td>
                <td>{{ $item->last_update_date != null ? date('d.m.Y', strtotime($item->last_update_date)) : 'N/A' }}
                </td>
                <td>{{ $item->full_name ?? 'N/A' }}</td>
                <td>{{ $item->gender ?? 'N/A' }}</td>
                <td>{{ $item->date_of_birth != null ? date('d.m.Y', strtotime($item->date_of_birth)) : 'N/A' }}</td>
                <td>{{ $item->date_of_birth != null ? \Carbon\Carbon::parse($item->date_of_birth)->age : 'N/A' }}</td>
                <td>{{ $item->education ?? 'N/A' }}</td>
                <td>{{ $item->contact_no ?? 'N/A' }}
                </td>
                <td>{{ $item->alternate_contact_no ?? 'N/A' }}
                </td>
                <td>{{ $item->whatapp_no ?? 'N/A' }}</td>
                <td>{{ $item->email ?? 'N/A' }}</td>
                <td>{{ $item->referred_by ?? 'N/A' }}</td>
                <td>
                    @if ($item->associate_id != null)
                        {{ $item->associatedBy->first_name  ?? 'N/A' }} {{ $item->associatedBy->last_name  ?? 'N/A' }}
                    @else
                        {{ 'N/A' }}
                    @endif
                <td>{{ $item->other_education ?? 'N/A' }}</td>
                <td>{{ $item->state->name ?? 'N/A'}}</td>
                <td>{{ $item->cityName->name ?? 'N/A' }}</td>
                <td>{{ $item->religion ?? 'N/A' }}</td>
                <td>{{ $item->ecr_type ?? 'N/A' }}</td>
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
                <td>{{ $item->english_speak ?? 'N/A' }}</td>
                <td>{{ $item->arabic_speak ?? 'N/A' }}</td>
                <td>{{ $item->return == 1 ? 'Yes' : 'No' }}</td>
                <td>{{ $item->positionAppliedFor1->name ?? 'N/A' }}</td>
                <td>{{ $item->positionAppliedFor2->name ?? 'N/A' }}</td>
                <td>{{ $item->positionAppliedFor3->name ?? 'N/A' }}</td>
                <td>{{ $item->passport_number ?? 'N/A' }}</td>
                <td>{{ $item->indian_exp ?? 'N/A' }}</td>
                <td>{{ $item->abroad_exp ?? 'N/A' }}</td>
                <td>
                    @if ($item->lastCandidateActivity != null)
                        {{ $item->lastCandidateActivity->remarks ?? 'N/A' }}
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
