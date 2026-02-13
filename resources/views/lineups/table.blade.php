@forelse($lineups as $lineup)
<tr>
    <td class="text-center">
        <input type="checkbox" class="form-check-input select-lineup" value="{{ $lineup->id }}">
    </td>
    <td>
        <div class="d-flex align-items-center">
            <div class="avatar avatar-xs me-2">
                <span class="avatar-title rounded-circle bg-soft-primary text-primary fw-bold"
                    style="width: 35px; height: 35px; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; background-color: #e0e7ff;">
                    {{ substr($lineup->candidate->full_name ?? 'C', 0, 1) }}
                </span>
            </div>
            <div>
                <div class="fw-bold text-nowrap">{{ $lineup->candidate->full_name ?? 'N/A' }}</div>
                <small
                    class="text-muted text-nowrap">{{ $lineup->candidate->passport_number ?? 'No Passport' }}</small>
            </div>
        </div>
    </td>
    <td>{{ $lineup->candidate->contact_no ?? 'N/A' }}</td>
    <td>{{ $lineup->interview->company->company_name ?? 'N/A' }}</td>
    <td>{{ $lineup->interview->job->job_name ?? 'N/A' }}</td>
    <td>
        <span class="badge bg-soft-info text-info p-2 text-nowrap">
            <i class="fa fa-calendar-alt me-1"></i>
            {{ $lineup->interview->interview_start_date ?? 'N/A' }}
        </span>
    </td>
    <td>
        @php
        $statusClass = '';
        if ($lineup->interview_status == 'Interested') {
        $statusClass = 'status-interested';
        } elseif ($lineup->interview_status == 'Not-Interested') {
        $statusClass = 'status-not-interested';
        } else {
        $statusClass = 'status-pending';
        }
        @endphp
        <span class="status-badge {{ $statusClass }} text-nowrap">
            {{ $lineup->interview_status ?? 'Pending' }}
        </span>
    </td>
    <td>
        <span class="text-nowrap">{{ $lineup->user->full_name ?? 'N/A' }}</span>
    </td>
    <td class="text-end">
        <div class="btn-group">
            @can('View Lineup')
            <button type="button" class="btn btn-sm btn-outline-info view-lineup-btn"
                data-id="{{ $lineup->id }}" title="View Details">
                <i class="fa fa-eye"></i>
            </button>
            @endcan

            @can('Edit Lineup')
            <button type="button" class="btn btn-sm btn-outline-success edit-status-btn"
                data-id="{{ $lineup->id }}" data-status="{{ $lineup->interview_status }}"
                data-remarks="{{ $lineup->status_remarks }}" title="Change Status">
                <i class="fa fa-exchange-alt"></i>
            </button>
            @endcan

            {{-- @can('Edit Lineup')
            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary edit-route"
                data-route="{{ route('candidates.edit', $lineup->candidate_id) }}" title="Edit candidate">
                <i class="fa fa-edit"></i>
            </a>
            @endcan --}}
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center py-5">
        <div class="text-muted">No lineups found.</div>
    </td>
</tr>
@endforelse

@if ($lineups->hasPages())
<tr>
    <td colspan="7" class="p-3">
        <div class="d-flex justify-content-center">
            {{ $lineups->appends(request()->query())->links() }}
        </div>
    </td>
</tr>
@endif
