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
        @foreach ($candidates as $candidate)
            <tr>
                <td>{{ date('d.m.Y', strtotime($candidate['created_at'])) ?? 'N/A' }}</td>
                <td>
                    @if (!empty($candidate['lastCandidateActivity']))
                        {{ $candidate['lastCandidateActivity']['remarks'] ?? 'N/A' }}
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>{{ $candidate['enter_by'] == 0 ? 'Mobile' : $candidate['enterBy']['full_name'] ?? 'N/A' }}</td>
                <td>
                    <div class="round_staus active">
                        {{ $candidate['candidateStatus']['name'] ?? 'N/A' }}
                    </div>
                </td>
                <td>{{ $candidate['mode_of_registration'] ?? 'N/A' }}</td>
                <td>{{ $candidate['source'] ?? 'N/A' }}</td>
                <td>{{ !empty($candidate['last_update_date']) ? date('d.m.Y', strtotime($candidate['last_update_date'])) : 'N/A' }}
                </td>
                <td>{{ $candidate['full_name'] ?? 'N/A' }}</td>
                <td>{{ $candidate['gender'] ?? 'N/A' }}</td>
                <td>{{ !empty($candidate['date_of_birth']) ? date('d.m.Y', strtotime($candidate['date_of_birth'])) : 'N/A' }}
                </td>
                <td>{{ !empty($candidate['date_of_birth']) ? \Carbon\Carbon::parse($candidate['date_of_birth'])->age : 'N/A' }}
                </td>
                <td>{{ $candidate['education'] ?? 'N/A' }}</td>
                <td>{{ $candidate['contact_no'] ?? 'N/A' }}</td>
                <td>{{ $candidate['alternate_contact_no'] ?? 'N/A' }}</td>
                <td>{{ '=' . '"' . $candidate['whatapp_no'] . '"' ?? 'N/A' }}</td>
                <td>{{ $candidate['email'] ?? 'N/A' }}</td>
                <td>{{ $candidate['referred_by'] ?? 'N/A' }}</td>
                <td>
                    @if (!empty($candidate['associate_id']))
                        {{ $candidate['associatedBy']['first_name'] ?? 'N/A' }}
                        {{ $candidate['associatedBy']['last_name'] ?? 'N/A' }}
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>{{ $candidate['other_education'] ?? 'N/A' }}</td>
                <td>{{ $candidate['state']['name'] ?? 'N/A' }}</td>
                <td>{{ $candidate['cityName']['name'] ?? 'N/A' }}</td>
                <td>{{ $candidate['religion'] ?? 'N/A' }}</td>
                <td>{{ $candidate['ecr_type'] ?? 'N/A' }}</td>
                <td>
                    @if (isset($candidate['candidateIndianLicence']) && count($candidate['candidateIndianLicence']) > 0)
                        @foreach ($candidate['candidateIndianLicence'] as $value)
                            <span class="badge bg-primary rounded-pill">
                                {{ $value['licence_name'] ?? 'N/A' }}
                            </span>
                        @endforeach
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>
                    @if (isset($candidate['candidateGulfLicence']) && count($candidate['candidateGulfLicence']) > 0)
                        @foreach ($candidate['candidateGulfLicence'] as $value)
                            <span class="badge bg-primary rounded-pill">
                                {{ $value['licence_name'] ?? 'N/A' }}
                            </span>
                        @endforeach
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>{{ $candidate['english_speak'] ?? 'N/A' }}</td>
                <td>{{ $candidate['arabic_speak'] ?? 'N/A' }}</td>
                <td>{{ $candidate['return'] == 1 ? 'Yes' : 'No' }}</td>
                <td>{{ $candidate['positionAppliedFor1']['name'] ?? 'N/A' }}</td>
                <td>{{ $candidate['positionAppliedFor2']['name'] ?? 'N/A' }}</td>
                <td>{{ $candidate['positionAppliedFor3']['name'] ?? 'N/A' }}</td>
                <td>{{ $candidate['passport_number'] ?? 'N/A' }}</td>
                <td>{{ $candidate['indian_exp'] ?? 'N/A' }}</td>
                <td>{{ $candidate['abroad_exp'] ?? 'N/A' }}</td>
                <td>
                    @if (!empty($candidate['lastCandidateActivity']))
                        {{ $candidate['lastCandidateActivity']['remarks'] ?? 'N/A' }}
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
            </tr>
        @endforeach


    </tbody>
</table>
