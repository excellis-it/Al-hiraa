@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Candidate Interview Report
@endsection
@push('styles')
<style>
    .select2-container--default .select2-results>.select2-results__options {
    max-height: 600px;
    overflow-y: auto;
}
</style>
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <!-- page-contain-start  -->
            <div class="integrations-div setting-profile-div">

                <div class="page__heading row align-items-center mb-0 mt-5">
                    <div class="col-xl-12 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Candidate Interview Report</h2>
                        </div>
                    </div>
                </div>

                <div class="profile-div">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="integrations-form profile-form">
                                <form action="{{ route('reports.candidate-interview-export') }}" method="POST" id="create-candidate"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-2 justify-content-between auto-fill">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Candidates <span>*</span></label>
                                                <select name="passport_number[]" class="form-select uppercase-text select_candidate" id="" >
                                                    <option value="" disabled>Select Candidates</option>
                                                    @foreach ($candidates as $candidate)
                                                        <option value="{{ $candidate->passport_number }}"
                                                            {{ old('passport_number') == $candidate->passport_number ? 'selected' : (isset($selectedLicenses) && in_array($candidate->id, $selectedLicenses) ? 'selected' : '') }}>
                                                            {{ $candidate->full_name }} ({{ $candidate->contact_no }})
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('passport_number'))
                                                    <span class="text-danger">{{ $errors->first('passport_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-2 justify-content-between ">
                                        <div class="col-lg-12">
                                            <div class="save-btn-div d-flex align-items-center">
                                                <button type="submit" class="btn save-btn">Export</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-contain-end  -->
        </div>


    </div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $(".select_candidate").select2({
            placeholder: "Select Candidate",
            allowClear: true,
        })
    });
</script>

{{-- <script>
        $(document).ready(function() {
            $(".select_candidate").select2({
                closeOnSelect: false,
                placeholder: "Select Candidate",
                ajax: {
                    url: '{{ route('reports.get-candidates') }}', // Endpoint for fetching candidates
                    dataType: 'json',
                    delay: 250, // Debounce delay
                    data: function(params) {
                        return {
                            search: params.term, // Search term
                            page: params.page || 1, // Pagination
                        };
                    },
                    processResults: function(data, params) {
                        // Set the page number for the next request
                        params.page = params.page || 1;

                        return {
                            results: data.results, // Candidates data
                            pagination: {
                                more: data.pagination.more, // Whether more results are available
                            },
                        };
                    },
                    cache: true,
                },
                minimumInputLength: 1, // Minimum characters for searching
            });

            // Preload the first 100 candidates (first page)
            $.ajax({
                url: '{{ route('reports.get-candidates') }}',
                data: {
                    page: 1, // First page
                },
                dataType: 'json',
                success: function(data) {
                    let options = [];
                    data.results.forEach(function(candidate) {
                        options.push(new Option(candidate.text, candidate.id, false, false));
                    });
                    $(".select_candidate").append(options).trigger('change');
                }
            });
        });
    </script> --}}
@endpush
