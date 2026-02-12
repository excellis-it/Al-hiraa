@forelse($lineups as $lineup)
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <div class="avatar avatar-xs me-2">
                    <span class="avatar-title rounded-circle bg-soft-primary text-primary fw-bold"
                        style="width: 35px; height: 35px; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; background-color: #e0e7ff;">
                        {{ substr($lineup->candidate->full_name ?? 'C', 0, 1) }}
                    </span>
                </div>
                <div>
                    <div class="fw-bold">{{ $lineup->candidate->full_name ?? 'N/A' }}</div>
                    <small class="text-muted">{{ $lineup->candidate->passport_number ?? 'No Passport' }}</small>
                </div>
            </div>
        </td>
        <td>{{ $lineup->candidate->contact_no ?? 'N/A' }}</td>
        <td>{{ $lineup->interview->company->company_name ?? 'N/A' }}</td>
        <td>{{ $lineup->interview->job->job_name ?? 'N/A' }}</td>
        <td>
            <span class="badge bg-soft-info text-info p-2">
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

            <span class="status-badge {{ $statusClass }}">
                {{ $lineup->interview_status ?? 'Pending' }}
            </span>

        </td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-info view-lineup-btn" data-id="{{ $lineup->id }}"
                    title="View Details">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-success edit-status-btn"
                    data-id="{{ $lineup->id }}" data-status="{{ $lineup->interview_status }}"
                    data-remarks="{{ $lineup->status_remarks }}" title="Change Status">
                    <i class="fa fa-exchange-alt"></i>
                </button>
                <a href="{{ route('candidates.edit', $lineup->candidate_id) }}" class="btn btn-sm btn-outline-primary"
                    title="Edit candidate">
                    <i class="fa fa-edit"></i>
                </a>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-5">
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
