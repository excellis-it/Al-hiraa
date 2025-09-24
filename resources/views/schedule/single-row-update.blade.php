<td>{{ $interview['job']['job_id'] ?? '-' }}</td>
<td>{{ $interview['job']['job_name'] ?? '-' }}</td>
<td>
    <span
        class="name_textbg">{{ isset($interview['user']['first_name']) ? substr($interview['user']['first_name'], 0, 1) : '' }}
        {{ isset($interview['user']['last_name']) ? substr($interview['user']['last_name'], 0, 1) : '' }}</span>
    {{ $interview['user']['first_name'] ?? '' }}
    {{ $interview['user']['last_name'] ?? '' }}
</td>
<td>
    {{ isset($interview['interview_start_date']) ? date('d/m/Y', strtotime($interview['interview_start_date'])) : '' }}
    @if (isset($interview['interview_start_date']) &&
            isset($interview['interview_end_date']) &&
            $interview['interview_start_date'] != $interview['interview_end_date']
    )
        -
        {{ date('d/m/Y', strtotime($interview['interview_end_date'])) }}
    @endif
</td>
<td>{{ $interview['interview_location'] ?? '-' }}</td>
<td>
    <a href="javascript:void(0);" class="edit-route"
        data-route="{{ route('schedule-to-do.edit', Crypt::encrypt($interview['id'])) }}">
        <i class="fas fa-edit"></i>
    </a>
</td>
