@if (isset($change))
<tr>
    <td>Enter By</td>
    <td>{{ $candidate->enterBy->full_name ?? '' }}
    </td>
</tr>
<tr>
    <td>Status</td>
    <td>{{ $candidate->candidateStatus->name ?? '' }}

    </td>
</tr>
<tr>
    <td>Mode of Registration</td>
    <td>{{ $candidate->mode_of_registration ?? '' }}

    </td>
</tr>
<tr>
    <td>Last Updated Date</td>
    <td>{{ $candidate->last_update_date != null ? date('d.m.Y', strtotime($candidate->last_update_date)) : 'N/A' }}

    </td>
</tr>
<tr>
    <td>Referred By</td>
    <td>
        @if ($candidate->referred_by_id != null)
            {{ $candidate->referredBy->full_name }}
        @else
            {{ $candidate->referred_by }}
        @endif
    </td>
</tr>
<tr>
    <td>Full Name</td>
    <td>{{ $candidate->full_name ?? 'N/A' }}
    </td>
</tr>
<tr>
    <td>Gender</td>
    <td>{{ $candidate->gender }}

    </td>
</tr>
<tr>
    <td>DOB</td>
    <td>{{ $candidate->date_of_birth != null ? date('d.m.Y', strtotime($candidate->date_of_birth)) : 'N/A' }}

    </td>
</tr>
<tr>
    <td>Age</td>
    <td>{{ $candidate->age }}

    </td>
</tr>
<tr>
    <td>Education</td>
    <td>{{ $candidate->education }}

    </td>
</tr>
<tr>
    <td>Other Education</td>
    <td>{{ $candidate->other_education ?? 'N/A' }}
    </td>
</tr>
<tr>
    <td>Alternate Contact No.</td>
    <td>{{ $candidate->alternate_contact_no ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Whatsapp No.</td>
    <td>{{ $candidate->whatapp_no ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Email ID</td>
    <td>{{ $candidate->email ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>City</td>
    <td>{{ $candidate->city ?? 'N/A' }}
    </td>
</tr>
<tr>
    <td>Religion</td>
    <td>{{ $candidate->religion ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>ECR Type</td>
    <td>{{ $candidate->ecr_type ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Indidan Driving Licence</td>
    <td>{{ $candidate->indian_driving_license ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>International Driving Licence</td>
    <td>{{ $candidate->international_driving_license ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>English Speak</td>
    <td>{{ $candidate->english_speak ?? 'N/A' }}
    </td>
</tr>
<tr>
    <td>Arabic Speak</td>
    <td>{{ $candidate->arabic_speak ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Return</td>
    <td>{{ $candidate->return ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Post Applied For</td>
    <td>{{ $candidate->candidateFieldUpdate->position ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Position</td>
    <td>{{ $candidate->position ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Indian Experience (If any?)</td>
    <td>{{ $candidate->indian_exp ?? 'N/A' }}
    </td>
</tr>
<tr>
    <td>Abroad Experience (If any?)</td>
    <td>{{ $candidate->abroad_exp ?? 'N/A' }}

    </td>
</tr>
<tr>
    <td>Remarks</td>
    <td>{{ $candidate->remarks ?? 'N/A' }}

    </td>
</tr>

@endif
