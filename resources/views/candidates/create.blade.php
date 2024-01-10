@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Candidates Create
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <!-- page-contain-start  -->
            <div class="integrations-div setting-profile-div">

                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-12 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Add Candidate</h2>
                        </div>
                    </div>
                </div>

                <div class="profile-div">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="integrations-form profile-form">
                                <form action="{{ route('candidates.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-2 justify-content-between">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Contact No: <span>*</span></label>
                                                <input type="text" class="form-control" id="contact_no" value=""
                                                    name="contact_no" value="{{ old('contact_no') }}" placeholder="">
                                                @if ($errors->has('contact_no'))
                                                    <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-2 justify-content-between auto-fill">
                                        @include('candidates.auto-fill')

                                    </div>
                                    <div class="row g-2 justify-content-between ">
                                        <div class="col-lg-12">
                                            <div class="save-btn-div d-flex align-items-center">
                                                <button type="submit" class="btn save-btn">save</button>
                                                <a href="{{ route('candidates.index') }}"
                                                    class="btn save-btn save-btn-1">Cancel</a>
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
            $('#contact_no').on('keyup', function() {
                var contact_no = $(this).val();
                if (contact_no.length == 10) {
                    $.ajax({
                        url: "{{ route('candidates.auto-fill') }}",
                        type: "GET",
                        data: {
                            contact_no: contact_no
                        },
                        success: function(response) {
                            $('.auto-fill').html(response.view);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.referred_type', function() {
                var type = $(this).text();
                // alert(type);
                if (type == 'Associate') {
                    $('.referred_by_id').html(
                        `<label for="">Referred by <span><a href="javascript:void(0);" class="referred_type">Other</a></span></label>
                    <select name="referred_by_id" class="form-control" id="">
                        <option value="">Select Type</option>
                        @foreach ($associates as $item)
                            <option value="{{ $item['id'] }}">{{ $item['full_name'] }}</option>
                        @endforeach
                    </select>`
                    );
                } else {
                    $('.referred_by_id').html(
                        `<label for="">Referred by <span><a href="javascript:void(0);" class="referred_type">Associate</a></span></label>
                    <input type="text" class="form-control" id="" name="referred_by" placeholder="">`
                    );
                }
            });
        });
    </script>
@endpush
