@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-body">
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="name_box">
                        <div class="">
                            <div class="name_box_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.706" height="22.275"
                                    viewBox="0 0 16.706 22.275">
                                    <g id="user_4_" data-name="user (4)" transform="translate(-64)">
                                        <circle id="Ellipse_323" data-name="Ellipse 323" cx="5.5" cy="5.5"
                                            r="5.5" transform="translate(67 0)" fill="#1492e6" />
                                        <path id="Path_330" data-name="Path 330"
                                            d="M72.353,298.667A8.363,8.363,0,0,0,64,307.02a.928.928,0,0,0,.928.928h14.85a.928.928,0,0,0,.928-.928A8.362,8.362,0,0,0,72.353,298.667Z"
                                            transform="translate(0 -285.673)" fill="#1492e6" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="">
                            <div class="name_box_text">
                                <p>Name</p>
                                <h4>{{ $candidate->full_name ?? 'N/A' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="name_box">
                        <div class="">
                            <div class="name_box_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.761" height="22.275"
                                    viewBox="0 0 20.761 22.275">
                                    <g id="phone-receiver-silhouette_2_" data-name="phone-receiver-silhouette (2)"
                                        transform="translate(-0.872 0)">
                                        <path id="Path_412" data-name="Path 412"
                                            d="M19.307,15.5c-1.346-1.151-2.711-1.848-4.04-.7l-.794.695c-.581.5-1.66,2.86-5.835-1.942S6.948,8.015,7.53,7.515l.8-.7c1.322-1.152.823-2.6-.13-4.094l-.575-.9C6.664.332,5.621-.646,4.3.5l-.716.626A6.724,6.724,0,0,0,.958,5.58C.48,8.742,1.988,12.364,5.444,16.337s6.83,5.972,10.031,5.937A6.742,6.742,0,0,0,20.243,20.3l.719-.627c1.322-1.149.5-2.319-.846-3.473Z"
                                            fill="#1492e6" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="">
                            <div class="name_box_text">
                                <p>Contact No:</p>
                                <h4>{{ $candidate->contact_no ?? 'N/A' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="name_box">
                        <div class="">
                            <div class="name_box_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 22 22">
                                    <g id="activity" transform="translate(-2.25 -1.5)">
                                        <path id="Path_409" data-name="Path 409"
                                            d="M16.1,3.88a.815.815,0,1,0,0-1.63H12.793c-2,0-3.559,0-4.8.134A6.327,6.327,0,0,0,4.825,3.443,6.247,6.247,0,0,0,3.443,4.825,6.327,6.327,0,0,0,2.384,7.993c-.134,1.241-.134,2.8-.134,4.8v.1c0,2,0,3.559.134,4.8A6.327,6.327,0,0,0,3.443,20.86a6.246,6.246,0,0,0,1.382,1.382A6.326,6.326,0,0,0,7.993,23.3c1.241.134,2.8.134,4.8.134h.1c2,0,3.559,0,4.8-.134a6.326,6.326,0,0,0,3.168-1.059,6.246,6.246,0,0,0,1.382-1.382A6.326,6.326,0,0,0,23.3,17.692c.134-1.241.134-2.8.134-4.8V9.583a.815.815,0,1,0-1.63,0v3.259c0,2.055,0,3.531-.125,4.674a4.742,4.742,0,0,1-.757,2.386A4.615,4.615,0,0,1,19.9,20.924a4.742,4.742,0,0,1-2.386.757c-1.143.124-2.619.125-4.674.125s-3.531,0-4.674-.125a4.742,4.742,0,0,1-2.386-.757A4.616,4.616,0,0,1,4.761,19.9,4.742,4.742,0,0,1,4,17.516c-.124-1.143-.125-2.619-.125-4.674s0-3.531.125-4.674a4.742,4.742,0,0,1,.757-2.386A4.617,4.617,0,0,1,5.783,4.761,4.742,4.742,0,0,1,8.169,4c1.143-.124,2.619-.125,4.674-.125Z"
                                            transform="translate(0 0.065)" fill="#1492e6" />
                                        <path id="Path_410" data-name="Path 410"
                                            d="M6.333,15.057a.815.815,0,1,0,1.463.718L9.383,12.54a1.294,1.294,0,0,1,2.36.08,2.924,2.924,0,0,0,5.331.181l1.587-3.234A.815.815,0,0,0,17.2,8.849l-1.586,3.234a1.294,1.294,0,0,1-2.36-.08,2.924,2.924,0,0,0-5.331-.181Z"
                                            transform="translate(0.346 0.596)" fill="#1492e6" />
                                        <path id="Path_411" data-name="Path 411"
                                            d="M17.5,4.216A2.716,2.716,0,1,0,20.216,1.5,2.716,2.716,0,0,0,17.5,4.216Zm1.63,0A1.086,1.086,0,1,0,20.216,3.13,1.086,1.086,0,0,0,19.13,4.216Z"
                                            transform="translate(1.318 0)" fill="#1492e6" fill-rule="evenodd" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="">
                            <div class="name_box_text">
                                <p>Status</p>
                                <div class="round_staus active">
                                    {{ $candidate->candidateStatus->name ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('candidates.update', $candidate->id) }}" method="POST" id="candidate-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="can-div d-flex justify-content-between align-items-center">
                        <div class="can-head">
                            <h4>Candidate Details</h4>
                        </div>
                        <div class="edit-1-btn d-flex align-items-center">

                            <div class="edit-2" id="cross-button">

                            </div>
                            <div class="edit-2 m-lg-1" id="submit-button">

                            </div>
                            <div class="edit-1" id="open-input">
                                <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="candidate_form candidate_edit_form">
                        <div class="table-responsive" id="tableContainer">
                            <table class="table">
                                <tbody id="candidate-form">
                                    {{-- @include('candidates.details-form') --}}
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
                                        <td>Source</td>
                                        <td>{{ $candidate->source ?? '' }}

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
                                        <td>{{ $candidate->return == 1 ? 'Yes' : 'N0' }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Post Applied For</td>
                                        <td>{{ $candidate->candidatePositions->name ?? 'N/A' }}

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


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="see-more-container">
                        <a href="javascript:void(0);" class="btn-1" id="seeMoreBtn">See More<img
                                src="{{ asset('assets/images/arrow.png') }}"></a>
                    </div>
                </div>
            </form>

            <div class="candidate_details">
                <h4>Updated Details</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Updated By</td>
                                <td>Jhon Doe
                                </td>
                            </tr>
                            <tr>
                                <td>Assigned By</td>
                                <td>Jhon Doe
                                </td>
                            </tr>
                            <tr>
                                <td>Mode of Registration</td>
                                <td>Done
                                </td>
                            </tr>
                            <tr>
                                <td>Source</td>
                                <td>01/07/2023
                                </td>
                            </tr>
                            <tr>
                                <td>Referred By</td>
                                <td>01/07/2023
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <a href="" class="btn-1">See More<img src="{{ asset('assets/images/arrow.png') }}"></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on("click", '#open-input', function(e) {
                $(this).html(``);
                $(".see-more-container").hide();
                $('#submit-button').html(
                    `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
                )

                $('#cross-button').html(
                    `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
                )

                $('#candidate-form').html(`<tr>
                    <td>Enter By</td>
        <td>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Enter by" aria-label="default input example" value="{{ $candidate->enterBy->full_name ?? '' }}" readonly>
          </div>
        </td>
      </tr>
      <tr>
        <td>Status</td>
        <td>
          <select name="cnadidate_status_id" class="form-control" id="">
            <option value="">Select A Status</option>
            @foreach ($candidate_statuses as $status)
            <option value="{{ $status->id }}" {{ $candidate->cnadidate_status_id == $status->id ? 'selected' : '' }}>
              {{ $status->name }}
            </option>
            @endforeach
          </select>
          <span class="text-danger"></span>
        </td>
      </tr>
      <tr>
        <td>Mode of Registration</td>
        <td>
          <input type="text" class="form-control" id="" value="{{ $candidate->mode_of_registration ?? '' }}" name="mode_of_registration" placeholder="Mode of Registration">
        </td>
      </tr>
      <tr>
        <td>Source</td>
    <td>
      <input type="text" class="form-control" id="" value="{{ $candidate->source ?? '' }}" name="source" placeholder="Source">
    </td>
  </tr>
      <tr>
        <td>Last Upadate Date</td>
        <td>
          <div class="form-group">
            <input type="date" class="form-control" id="" value="{{ $candidate->last_update_date ?? '' }}" name="last_update_date" placeholder="Last Upadate Date">
          </div>
        </td>
      </tr>
      <tr>
        <td>Referred By</td>
        <td>
          <input type="text" class="form-control" id="" value=" @if ($candidate->referred_by_id != null) {{ $candidate->referredBy->full_name }}@else{{ $candidate->referred_by }} @endif" placeholder="Referred By" readonly>
          </select>
        </td>
      </tr>

      <tr>
        <td>Full Name</td>
        <td>
          <div class="form-group">
            <input type="text" class="form-control" id="" value="{{ $candidate->full_name ?? '' }}" name="full_name" placeholder="Full Name">
            <span class="text-danger"></span>
          </div>
        </td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>
          <select name="gender" class="form-control" id="">
            <option value="">Select Gender</option>
            <option value="Male" {{ $candidate->gender == 'Male' ? 'selected' : '' }}> Male </option>
            <option value="Female" {{ $candidate->gender == 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ $candidate->gender == 'Other' ? 'selected' : '' }}>Other</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>DOB</td>
        <td>
          <div class="form-group">
            <input type="date" class="form-control" id="" value="{{ date('Y-m-d', strtotime($candidate->date_of_birth)) ?? '' }}" name="dob" max="{{ date('Y-m-d') }}" placeholder="DOB">
            <span class="text-danger"></span>
          </div>
        </td>
      </tr>
      <tr>
        <td>Age</td>
        <td>
            <input type="text" class="form-control" id="" value="{{ $candidate->age ?? '' }}" name="age" placeholder="Age">
        </td>
      </tr>
      <tr>
        <td>Education</td>
        <td>
          <input type="text" class="form-control" id="" value="{{ $candidate->education ?? '' }}" name="education" placeholder="Education">
        </td>
      </tr>
      <tr>
        <td>Other Education</td>
        <td>
          <input type="text" class="form-control" id="" value="{{ $candidate->other_education ?? '' }}" name="other_education" placeholder="Other Education">
          </select>
        </td>
      </tr>
      <tr>
        <td>Contact No.</td>
        <td>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Contact No." aria-label="" readonly value="{{ $candidate['contact_no'] }}">
          </div>
        </td>
      </tr>
      <tr>
        <td>Alternate Contact No.</td>
        <td>
          <div class="form-group">
            <input type="text" class="form-control" id="" name="alternate_contact_no" value="{{ $candidate->alternate_contact_no ?? '' }}" placeholder="Alternate Contact No.">
          </div>
        </td>
      </tr>
      <tr>
        <td>Whatsapp No.</td>
        <td>
          <div class="form-group">
            <input type="text" class="form-control" id="" name="whatapp_no" value="{{ $candidate->whatapp_no ?? '' }}" placeholder="Whats App No.">
          </div>
        </td>
      </tr>
      <tr>
        <td>Email ID</td>
        <td>
          <div class="form-group">
            <input type="text" class="form-control" id="" value="{{ $candidate->email ?? '' }}" name="email" placeholder="Email ID">
          </div>
        </td>
      </tr>
      <tr>
        <td>City</td>
        <td>
            <input type="text" class="form-control" id="" name="city" value="{{ $candidate->city ?? '' }}" placeholder="City">
        </td>
      </tr>
      <tr>
        <td>Religion</td>
        <td>
          <input type="text" class="form-control" id="" name="religion" value="{{ $candidate->religion ?? '' }}" placeholder="Religion">
        </td>
      </tr>
      <tr>
        <td>ECR Type</td>
        <td>
          <select name="ecr_type" class="form-control" id="">
            <option value="">Select ECR</option>
            <option value="ECR" {{ $candidate->ecr_type == 'ECR' ? 'selected' : '' }}>ECR</option>
            <option value="ENCR" {{ $candidate->ecr_type == 'ENCR' ? 'selected' : '' }}>ENCR</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Indian Driving License</td>
        <td>
          <input type="text" class="form-control" id="" name="indian_driving_license" value="{{ $candidate->indian_driving_license ?? '' }}" placeholder="Indian Driving License">
        </td>
      </tr>
      <tr>
        <td>International Driving License</td>
        <td>
          <input type="text" class="form-control" id="" name="international_driving_license" value="{{ $candidate->international_driving_license ?? '' }}" placeholder="International Driving License">
        </td>
      </tr>


      <tr>
        <td>English Speak</td>
        <td>
          <select name="english_speak" class="form-control" id="">
            <option value="">English Speak</option>
            <option value="Basic" {{ $candidate->english_speak == 'Basic' ? 'selected' : '' }}>Basic</option>
            <option value="Good" {{ $candidate->english_speak == 'Good' ? 'selected' : '' }}>Good</option>
            <option value="Poor" {{ $candidate->english_speak == 'Poor' ? 'selected' : '' }}>Poor</option>
            <option value="No" {{ $candidate->english_speak == 'No' ? 'selected' : '' }}>No</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Arabic Speak</td>
        <td>
          <select name="arabic_speak" class="form-control" id="">
            <option value="">Arabic Speak</option>
            <option value="Basic" {{ $candidate->english_speak == 'Basic' ? 'selected' : '' }}>Basic</option>
            <option value="Good" {{ $candidate->english_speak == 'Good' ? 'selected' : '' }}>Good</option>
            <option value="Poor" {{ $candidate->english_speak == 'Poor' ? 'selected' : '' }}>Poor</option>
            <option value="No" {{ $candidate->english_speak == 'No' ? 'selected' : '' }}>No</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Return</td>
        <td>
          <select name="return" class="form-control" id="">
            <option value="">Return</option>
            <option value="1" {{ $candidate->return == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $candidate->return == '0' ? 'selected' : '' }}>No</option>
          </select>
        </td>
      </tr>

      <tr>
        <td>Post Applied For</td>
        <td>
          <input type="text" class="form-control" id="" value="{{ $candidate->candidatePositions->name ?? '' }}" name="position_applied_for" placeholder="Position Applied For">

        </td>
      </tr>

      <tr>
        <td>Position</td>
        <td>
            <input type="text" class="form-control" id="" value="{{ $candidate->position ?? '' }}"
                name="position" placeholder="">
        </td>
      </tr>
      <tr>
        <td>Indian Experience (If any?)</td>
        <td>
          <input type="text" class="form-control" id="" value="{{ $candidate->indian_exp ?? '' }}" name="indian_exp" placeholder="Indian Work Experience (If Any?)">
        </td>
      </tr>
      <tr>
        <td>Abroad Experience (If any?)</td>
        <td>
          <input type="text" class="form-control" id="" value="{{ $candidate->abroad_exp ?? '' }}" name="abroad_exp" placeholder="Abroad Work Experience (If Any?)">
        </td>
      </tr>
      <tr>
        <td>Remarks</td>
        <td>
          <div class="form-group">
            <textarea class="form-control" id="" rows="3" name="remark" placeholder="Remark">{{ $candidate->remarks ?? '' }}</textarea>
          </div>
        </td>
      </tr>`)
            });
            $(document).on("click", '#cross-button', function(e) {

                $(this).html(``);
                $(".see-more-container").hide();
                $('#submit-button').html(``)
                $('#open-input').html(
                    ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
                $('#candidate-form').html(` <tr>
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
                                        <td>Source</td>
                                        <td>{{ $candidate->source ?? '' }}

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
                                        <td>{{ $candidate->return == 1 ? 'Yes' : 'N0' }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Post Applied For</td>
                                        <td>{{ $candidate->candidatePositions->name ?? 'N/A' }}

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
                                    </tr>`);
                var visibleRows = 5;
                showRows(visibleRows);

                // Handle the "See More" button click
                $(document).on("click", '#seeMoreBtn', function(e) {
                    e.preventDefault();
                    // Show additional rows (e.g., 5 more)
                    visibleRows += 25;
                    showRows(visibleRows);
                });

                // Function to show the specified number of rows
                function showRows(rowsToShow) {
                    var $tableContainer = $("#tableContainer");
                    var $tableRows = $tableContainer.find("tbody tr");

                    // Hide all rows
                    $tableRows.hide();

                    // Show the specified number of rows
                    $tableRows.slice(0, rowsToShow).show();

                    // Toggle the "See More" button visibility based on the total number of rows
                    if ($tableRows.length > rowsToShow) {
                        $(".see-more-container").show();
                    } else {
                        $(".see-more-container").hide();
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Show the first 5 rows initially
            var visibleRows = 5;
            showRows(visibleRows);

            // Handle the "See More" button click
            $(document).on("click", '#seeMoreBtn', function(e) {
                e.preventDefault();
                // Show additional rows (e.g., 5 more)
                visibleRows += 25;
                showRows(visibleRows);
            });

            // Function to show the specified number of rows
            function showRows(rowsToShow) {
                var $tableContainer = $("#tableContainer");
                var $tableRows = $tableContainer.find("tbody tr");

                // Hide all rows
                $tableRows.hide();

                // Show the specified number of rows
                $tableRows.slice(0, rowsToShow).show();

                // Toggle the "See More" button visibility based on the total number of rows
                if ($tableRows.length > rowsToShow) {
                    $(".see-more-container").show();
                } else {
                    $(".see-more-container").hide();
                }
            }

            $(document).on('submit', '#candidate-edit-form', function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.reload();
                        toastr.success('Candidate details updated successfully');
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('[name="' + key + '"]').next('.text-danger').html(value[
                                0]);
                        });
                    }
                });
            });
        });
    </script>
@endif
