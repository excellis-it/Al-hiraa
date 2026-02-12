<div class="lineup-details-premium">
    <!-- Header Section -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="info-section h-100">
                <div class="section-header d-flex align-items-center mb-3">
                    <div class="icon-box bg-soft-primary text-primary me-2">
                        <i class="fa fa-user"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Candidate Information</h5>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Full Name</span>
                        <span class="value fw-bold text-dark">{{ $lineup->candidate->full_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Passport</span>
                        <span class="value">{{ $lineup->candidate->passport_number ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Contact</span>
                        <span class="value">{{ $lineup->candidate->contact_no ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">WhatsApp</span>
                        <span class="value text-success fw-bold">{{ $lineup->candidate->whatapp_no ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Email</span>
                        <span class="value">{{ $lineup->candidate->email ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Gender</span>
                        <span class="value">{{ $lineup->candidate->gender ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Education</span>
                        <span class="value">{{ $lineup->candidate->education ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">English/Arabic</span>
                        <span class="value">{{ $lineup->candidate->english_speak ?? 'N/A' }} /
                            {{ $lineup->candidate->arabic_speak ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-section h-100">
                <div class="section-header d-flex align-items-center mb-3">
                    <div class="icon-box bg-soft-info text-info me-2">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Interview Details</h5>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Company</span>
                        <span class="value fw-bold">{{ $lineup->interview->company->company_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Job Title</span>
                        <span class="value">{{ $lineup->interview->job->job_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Job ID</span>
                        <span class="value"><span
                                class="badge bg-light text-primary border">{{ $lineup->interview->job->job_id ?? 'N/A' }}</span></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Interview Date</span>
                        <span
                            class="value text-info fw-bold">{{ $lineup->interview->interview_start_date ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Interview Status</span>
                        <span class="value">
                            @php
                                $statusClass = '';
                                if ($lineup->interview_status == 'Interested') {
                                    $statusClass = 'bg-success';
                                } elseif ($lineup->interview_status == 'Not-Interested') {
                                    $statusClass = 'bg-danger';
                                } else {
                                    $statusClass = 'bg-warning text-dark';
                                }
                            @endphp
                            <span
                                class="badge {{ $statusClass }}">{{ $lineup->interview_status ?? 'Pending' }}</span>
                        </span>
                    </div>
                    <div class="info-item vertical">
                        <span class="label mb-1">Status Remarks</span>
                        <span class="value p-2 bg-light rounded text-muted italic border-start border-primary border-3"
                            style="font-size: 0.85rem;">
                            "{{ $lineup->status_remarks ?? 'No remarks provided' }}"
                        </span>
                    </div>
                    <div class="info-item mt-2 pt-2 border-top">
                        <span class="label" style="font-size: 0.75rem;">Last Updated By</span>
                        <span class="value fw-bold"
                            style="font-size: 0.8rem;">{{ $lineup->statusUpdater->full_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label" style="font-size: 0.75rem;">Assigned By</span>
                        <span class="value fw-bold"
                            style="font-size: 0.8rem;">{{ $lineup->user->full_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label" style="font-size: 0.75rem;">Assigned At</span>
                        <span class="value"
                            style="font-size: 0.8rem;">{{ $lineup->created_at->format('d-m-Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Section -->
    <div class="history-section mt-4 pt-4 border-top">
        <div class="section-header d-flex align-items-center mb-3">
            <div class="icon-box bg-soft-secondary text-secondary me-2">
                <i class="fa fa-history"></i>
            </div>
            <h5 class="mb-0 fw-bold">Status Change History</h5>
        </div>
        <div class="table-responsive rounded-3 border">
            <table class="table table-sm table-hover mb-0 premium-history-table">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3 py-3">Date & Time</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Remarks</th>
                        <th class="py-3 pe-3">Updated By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lineup->statusLogs as $log)
                        <tr>
                            <td class="ps-3 py-2 text-muted" style="font-size: 0.85rem;">
                                {{ $log->created_at->format('d M, Y H:i A') }}</td>
                            <td class="py-2">
                                @php
                                    $lClass = '';
                                    if ($log->status == 'Interested') {
                                        $lClass = 'bg-success';
                                    } elseif ($log->status == 'Not-Interested') {
                                        $lClass = 'bg-danger';
                                    } else {
                                        $lClass = 'bg-warning text-dark';
                                    }
                                @endphp
                                <span class="badge {{ $lClass }} rounded-pill px-3"
                                    style="font-size: 0.7rem;">{{ $log->status }}</span>
                            </td>
                            <td class="py-2">
                                <span class="text-dark" style="font-size: 0.85rem;">{{ $log->remarks ?? '--' }}</span>
                            </td>
                            <td class="py-2 pe-3 fw-medium text-dark" style="font-size: 0.85rem;">
                                {{ $log->updater->full_name ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fa fa-info-circle me-1"></i> No status changes on record.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .bg-soft-info {
        background-color: rgba(13, 202, 240, 0.1);
    }

    .bg-soft-secondary {
        background-color: rgba(108, 117, 125, 0.1);
    }

    .icon-box {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .info-section {
        background: #fff;
        border-radius: 12px;
    }

    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px dashed #eee;
        padding-bottom: 8px;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-item.vertical {
        flex-direction: column;
        align-items: flex-start;
        border-bottom: none;
    }

    .info-item .label {
        color: #6c757d;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .info-item .value {
        color: #212529;
        font-size: 0.9rem;
    }

    .premium-history-table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #dee2e6;
    }

    .italic {
        font-style: italic;
    }
</style>
