<table class="table mb-0 table-bordered">
    <thead>
        <tr>
            {{-- <th></th> --}}
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
            <th>Other Education</th>
            <th>City</th>
            <th>Religion</th>
            <th>ECR Type</th>
            <th>Indidan Driving Licence</th>
            <th>International Driving Licence</th>
            <th>English Speak</th>
            <th>Arabic Speak</th>
            <th>Return</th>
            <th>Post Applied For</th>
            <th>Position</th>
            <th>Indian Experience (If any?)</th>
            <th>Abroad Experience (If any?)</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody class="list" id="candidate_body">
        @foreach ($candidates as $item)
        <tr>
            <td>{{ $item->remarks ?? 'N/A' }}</td>
            <td>{{ $item->enterBy->full_name  ?? 'N/A'}}</td>
            <td>
                <div class="round_staus active">
                    {{ $item->candidateStatus->name  ?? 'N/A'}}
                </div>
            </td>
            <td>{{ $item->mode_of_registration ?? 'N/A' }}</td>
            <td>
                {{ $item->source ?? 'N/A' }}
            </td>
            <td>{{ $item->last_update_date != null ? date('d.m.Y', strtotime($item->last_update_date)) : 'N/A' }}</td>
            <td>{{ $item->full_name  ?? 'N/A'}}</td>
            <td>{{ $item->gender  ?? 'N/A'}}</td>
            <td>{{ $item->date_of_birth != null ? date('d.m.Y', strtotime($item->date_of_birth)) : 'N/A' }}</td>
            <td>{{ $item->age  ?? 'N/A'}}</td>
            <td>{{ $item->education  ?? 'N/A'}}</td>
            <td>{{ $item->contact_no  ?? 'N/A'}}
            </td>
            <td>{{ $item->alternate_contact_no ?? 'N/A' }}
            </td>
            <td>{{ $item->whatapp_no  ?? 'N/A'}}</td>
            <td>{{ $item->email ?? 'N/A' }}</td>
            <td> @if ($item->referred_by_id != null)
                {{ $item->referredBy->full_name }}
            @else
                {{ $item->referred_by }}
            @endif</td>
            <td>{{ $item->other_education ?? 'N/A' }}</td>
            <td>{{ $item->city ?? 'N/A' }}
            </td>
            <td>{{ $item->religion ?? 'N/A' }}</td>
            <td>{{ $item->ecr_type ?? 'N/A' }}</td>
            <td>{{ $item->indian_driving_license ?? 'N/A' }}</td>
            <td>{{ $item->international_driving_license  ?? 'N/A'}}</td>
            <td>{{ $item->english_speak ?? 'N/A' }}</td>
            <td>{{ $item->arabic_speak ?? 'N/A' }}</td>
            <td>{{ ($item->return == 1)? 'Yes' : 'N0' }}</td>
            <td>{{ $item->candidateFieldUpdate->position ?? 'N/A' }}</td>
            <td>{{ $item->position  ?? 'N/A'}}</td>
            <td>{{ $item->indian_exp  ?? 'N/A'}}</td>
            <td>{{ $item->abroad_exp ?? 'N/A' }}</td>
            <td>{{ $item->remarks  ?? 'N/A'}}</td>
        </tr>
        @endforeach

    </tbody>
</table>
