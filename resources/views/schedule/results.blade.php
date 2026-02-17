@if (count($interviews) > 0)
    <!-- Table Section -->
    <div class="table-wrapper table-responsive border-bottom">
        <table class="table mb-0 table-bordered" id="schedule-table">
            <thead class="candy-p">
                <tr class="border-bottom">
                    <th class="">Company</th>
                    <th class="">Interview ID</th>
                    <th class="">Job Name</th>
                    <th class="">Assignee</th>
                    <th class="">Interview Date</th>
                    <th class="">Interview Location</th>
                    <th class="">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($interviews as $interview)
                    <tr id="single-row-update-{{ $interview['id'] }}" class="border-bottom"
                        data-company-id="{{ $interview['company_id'] }}"
                        data-company-name="{{ $interview['company']['company_name'] ?? '' }}"
                        data-interview-date="{{ $interview['interview_start_date'] ?? '' }}">

                        @include('schedule.single-row-update')
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    @if (isset($paginationHtml) && $paginationHtml)
        <div class="mt-4">
            {!! $paginationHtml !!}
        </div>
    @endif
@else
    <!-- Empty State -->
    <div class="text-center py-5">
        <div class="mb-3">
            <i class="fa-solid fa-calendar-xmark fa-4x text-muted opacity-25"></i>
        </div>
        <h6 class="text-muted mb-2">No Interviews Found</h6>
        <p class="text-muted small mb-0">Try adjusting your filters or add a new interview.</p>
    </div>
@endif
