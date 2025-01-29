@if (count($interviews) > 0)
    <div class="accordion" id="interviewAccordion">
        @php
            $count = 0;
        @endphp
        @foreach ($interviews as $key => $items)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $count }}">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $count }}"
                        aria-expanded="false"
                        aria-controls="collapse{{ $count }}">
                        {{ $key }}
                    </button>
                </h2>
                <div id="collapse{{ $count }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="heading{{ $count }}" data-bs-parent="#interviewAccordion">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th>Job Name</th>
                                        <th>Assignee</th>
                                        <th>Interview Date</th>
                                        <th>Interview Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $interview)
                                        <tr id="single-row-update-{{$interview['id']}}">
                                            @include('schedule.single-row-update')
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="javascript:void(0);" class="add_task"
                            data-route="{{ route('schedule-to-do.job-create', Crypt::encrypt($interview['company_id'])) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.483" height="13.483"
                                viewBox="0 0 13.483 13.483">
                                <path id="plus-small"
                                    d="M18.359,11.618H13.865V7.124A1.124,1.124,0,0,0,12.741,6h0a1.124,1.124,0,0,0-1.124,1.124v4.494H7.124A1.124,1.124,0,0,0,6,12.741H6a1.124,1.124,0,0,0,1.124,1.124h4.494v4.494a1.124,1.124,0,0,0,1.124,1.124h0a1.124,1.124,0,0,0,1.124-1.124V13.865h4.494a1.124,1.124,0,0,0,1.124-1.124h0A1.124,1.124,0,0,0,18.359,11.618Z"
                                    transform="translate(-6 -6)" opacity="0.5" />
                            </svg>
                            <span>Add job...</span>
                        </a>
                    </div>
                </div>
            </div>
            @php
                $count++;
            @endphp
        @endforeach
    </div>
@else
    <div class="text-center">
        <h4>No Interview Found</h4>
    </div>
@endif
