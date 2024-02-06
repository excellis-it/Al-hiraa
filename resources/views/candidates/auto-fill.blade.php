@php
    use App\Constants\Position;
@endphp

@if (isset($autofill))
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Full Name <span>*</span></label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->full_name ?? '' }}" name="full_name" placeholder="">
            @if ($errors->has('full_name'))
                <span class="text-danger">{{ $errors->first('full_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->email ?? '' }}" name="email" placeholder="">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Alternative Contact NO: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="alternate_contact_no"
                value="{{ $candidate->alternate_contact_no ?? '' }}" placeholder="">
            @if ($errors->has('alternate_contact_no'))
                @error('alternate_contact_no')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Whatsapp NO: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="whatapp_no"
                value="{{ $candidate->whatapp_no ?? '' }}" placeholder="">
            @if ($errors->has('whatapp_no'))
                <span class="text-danger">{{ $errors->first('whatapp_no') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Passport Number: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="passport_number"
                value="{{ $candidate->passport_number ?? '' }}" placeholder="">
            @if ($errors->has('passport_number'))
                <span class="text-danger">{{ $errors->first('passport_number') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">City: </label>
            <select name="city" class="form-select select2 uppercase-text" id="">
                <option value="">Select City</option>
                @foreach (Position::getCity() as $city)
                    <option value="{{ $city }}" {{ $candidate->city == $city ? 'selected' : '' }}>
                        {{ $city }}
                    </option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control  uppercase-text" id="" name="city"
                value="{{ $candidate->city ?? '' }}" placeholder=""> --}}
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gender</label>
            <select name="gender" class="form-select  uppercase-text" id="">
                <option value="">Select Gender</option>
                <option value="Male" {{ $candidate->gender == 'Male' ? 'selected' : '' }}> Male </option>
                <option value="Female" {{ $candidate->gender == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ $candidate->gender == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">DOB </label>
            <input type="date" class="form-control  uppercase-text" id=""
                value="{{ date('Y-m-d', strtotime($candidate->date_of_birth)) ?? '' }}" name="dob"
                max="{{ date('Y-m-d') }}" placeholder="">
            @if ($errors->has('dob'))
                <span class="text-danger">{{ $errors->first('dob') }}</span>
            @endif
        </div>
    </div>
    {{-- <div class="col-lg-4">
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" class="form-control  uppercase-text" id="" value="{{ $candidate->age ?? '' }}"
                name="age" placeholder="">
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Education</label>
            {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ $candidate->education ?? '' }}"
                name="education" placeholder=""> --}}
            <select name="education" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="5th Pass" {{ $candidate->education == '5th Pass' ? 'selected' : '' }}>5th Pass</option>
                <option value="8th Pass" {{ $candidate->education == '8th Pass' ? 'selected' : '' }}>8th Pass</option>
                <option value="10th Pass" {{ $candidate->education == '10th Pass' ? 'selected' : '' }}>10th Pass
                </option>
                <option value="Higher Secondary" {{ $candidate->education == 'Higher Secondary' ? 'selected' : '' }}>
                    Higher Secondary
                </option>
                <option value="Graduates" {{ $candidate->education == 'Graduates' ? 'selected' : '' }}>Graduates
                </option>
                <option value="Masters" {{ $candidate->education == 'Masters' ? 'selected' : '' }}>Masters</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Other Education</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->other_education ?? '' }}" name="other_education" placeholder="">
        </div>
    </div>

    {{-- Mode of Registration --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Mode of Registration</label>
            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->mode_of_registration ?? '' }}" name="mode_of_registration" placeholder=""> --}}
            <select name="mode_of_registration" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Calling" {{ $candidate->mode_of_registration == 'Calling' ? 'selected' : '' }}>Calling
                </option>
                <option value="Walk-in" {{ $candidate->mode_of_registration == 'Walk-in' ? 'selected' : '' }}>Walk-in
                </option>
            </select>
        </div>
    </div>
    {{-- Source --}}

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Source</label>
            {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ $candidate->source ?? '' }}"
                name="source" placeholder=""> --}}
            <select name="source" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Telecalling" {{ $candidate->source == 'Telecalling' ? 'selected' : '' }}>Telecalling
                </option>
                <option value="Reference" {{ $candidate->source == 'Reference' ? 'selected' : '' }}>Reference</option>
                <option value="Facebook" {{ $candidate->source == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="Instagram" {{ $candidate->source == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                <option value="Others" {{ $candidate->source == 'Others' ? 'selected' : '' }}>Others </option>
            </select>
        </div>
    </div>

    {{-- referred_by --}}

    <div class="col-lg-4">
        <div class="form-group referred_by_id" id="">

            @if ($candidate->referred_by_id != null)
                <label for="">Referred by <span><a href="javascript:void(0);"
                            class="referred_type">Other</a></span></label>
                <select name="referred_by_id" class="form-select  uppercase-text" id="">
                    <option value="">Select Type</option>
                    @foreach ($associates as $item)
                        <option value="{{ $item['id'] }}"
                            {{ $candidate->referred_by_id == $item['id'] ? 'selected' : '' }}>{{ $item['full_name'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <label for="">Referred by <span><a href="javascript:void(0);"
                            class="referred_type">Agents</a></span></label>
                <input type="text" class="form-control  uppercase-text" id=""
                    value="{{ $candidate->referred_by ?? '' }}" name="referred_by" placeholder="">
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Religion: </label>
            <select name="religion" class="form-select  uppercase-text" id="">
                <option value="">Select Religion</option>
                <option value="Hindu" {{ $candidate->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Islam" {{ $candidate->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Christian" {{ $candidate->religion == 'Christian' ? 'selected' : '' }}>Christian
                </option>
                <option value="Sikh" {{ $candidate->religion == 'Sikh' ? 'selected' : '' }}>Sikh</option>
                <option value="Buddhist" {{ $candidate->religion == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                <option value="Jain" {{ $candidate->religion == 'Jain' ? 'selected' : '' }}>Jain</option>
                <option value="Other" {{ $candidate->religion == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Driving License: </label>
            <select name="indian_driving_license[]" class="form-select  uppercase-text select2" id=""
                multiple>
                <option value="" disabled>Select Indian Driving License</option>
                <option value="2 WHEELER" {{ in_array('2 WHEELER', $indian_driving_license) ? 'selected' : '' }}>
                    2 WHEELER</option>
                <option value="4 WHEELER" {{ in_array('4 WHEELER', $indian_driving_license) ? 'selected' : '' }}>
                    4 WHEELER</option>
                <option value="HV" {{ in_array('HV', $indian_driving_license) ? 'selected' : '' }}>HV</option>
            </select>

        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gulf Driving License: </label>
            {{-- <input type="text" class="form-control  uppercase-text" id="" name="international_driving_license"
                value="{{ $candidate->international_driving_license ?? '' }}" placeholder=""> --}}
            <select name="international_driving_license[]" class="form-select  uppercase-text select2" id=""
                multiple>
                <option value="" disabled>Select Gulf Driving License</option>
                <option value="2 WHEELER" {{ in_array('2 WHEELER', $gulf_driving_license) ? 'selected' : '' }}>
                    2 WHEELER</option>
                <option value="4 WHEELER" {{ in_array('4 WHEELER', $gulf_driving_license) ? 'selected' : '' }}>
                    4 WHEELER</option>
                <option value="HV" {{ in_array('HV', $gulf_driving_license) ? 'selected' : '' }}>HV</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">English Speak</label>
            <select name="english_speak" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Basic" {{ $candidate->english_speak == 'Basic' ? 'selected' : '' }}>Basic</option>
                <option value="Good" {{ $candidate->english_speak == 'Good' ? 'selected' : '' }}>Good</option>
                <option value="Poor" {{ $candidate->english_speak == 'Poor' ? 'selected' : '' }}>Poor</option>
                <option value="NO" {{ $candidate->english_speak == 'NO' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Arabic Speak</label>
            <select name="arabic_speak" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Basic" {{ $candidate->english_speak == 'Basic' ? 'selected' : '' }}>Basic</option>
                <option value="Good" {{ $candidate->english_speak == 'Good' ? 'selected' : '' }}>Good</option>
                <option value="Poor" {{ $candidate->english_speak == 'Poor' ? 'selected' : '' }}>Poor</option>
                <option value="NO" {{ $candidate->english_speak == 'NO' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gulf Return</label>
            <select name="return" class="form-select  uppercase-text" id="">
                <option value="">Select Gulf Return </option>
                <option value="1" {{ $candidate->return == '1' ? 'selected' : '' }}>YES</option>
                <option value="0" {{ $candidate->return == '0' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">ECR Type</label>
            <select name="ecr_type" class="form-select  uppercase-text" id="">
                <option value="">Select ECR</option>
                <option value="ECR" {{ $candidate->ecr_type == 'ECR' ? 'selected' : '' }}>ECR</option>
                <option value="ECNR" {{ $candidate->ecr_type == 'ECNR' ? 'selected' : '' }}>ECNR</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Work Experience (If Any?)</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->indian_exp ?? '' }}" name="indian_exp" placeholder="">
            @if ($errors->has('indian_exp'))
                @error('indian_exp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif

        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Abroad Work Experience (If Any?)</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->abroad_exp ?? '' }}" name="abroad_exp" placeholder="">
            @if ($errors->has('abroad_exp'))
                @error('abroad_exp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group position_applied_1">

            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->position_applied_for_1 ?? '' }}" name="position_applied_for_1" placeholder=""> --}}
            @if ($candidate->positionAppliedFor1)
                @if ($candidate->positionAppliedFor1()->where('is_active', 1)->count() > 0)
                    <label for="">Position Applied For(1) <span>* </span> <span><a href="javascript:void(0);"
                                class="position_applied_for_1 ">Other</a></span></label>
                    <select name="position_applied_for_1"
                        class="form-select  uppercase-text select2 positionAppliedFor1" id="">
                        <option value="">Select Position</option>
                        @foreach ($candidate_positions as $item)
                            <option value="{{ $item['id'] }}"
                                {{ $candidate->position_applied_for_1 == $item['id'] ? 'selected' : '' }}>
                                {{ $item['name'] }}</option>
                        @endforeach
                    </select>
                @else
                    <label for="">Position Applied For(1) <span>* </span> <span><a href="javascript:void(0);"
                                class="position_applied_for_1">List</a></span></label>
                    <input type="text" class="form-control  uppercase-text" id=""
                        value="{{ $candidate->positionAppliedFor1->name ?? '' }}" name="position_applied_for_1"
                        placeholder="">
                @endif
            @else
                <label for="">Position Applied For(1) <span>* </span> <span><a href="javascript:void(0);"
                            class="position_applied_for_1">Other</a></span></label>
                <select name="position_applied_for_1" class="form-select  uppercase-text select2 positionAppliedFor1"
                    id="">
                    <option value="">Select Position</option>
                    @foreach ($candidate_positions as $item)
                        <option value="{{ $item['id'] }}"
                            {{ $candidate->position_applied_for_1 == $item['id'] ? 'selected' : '' }}>
                            {{ $item['name'] }}</option>
                    @endforeach
                </select>
            @endif

            @if ($errors->has('position_applied_for_1'))
                @error('position_applied_for_1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    @if ($candidate->positionAppliedFor1)
        @if ($candidate->positionAppliedFor1()->where('is_active', 1)->count() > 0)
            <div class="col-lg-4 specialisation_1">
                <div class="form-group "><label>Specialisation for Position (1)</label><input type="text"
                        value="{{ $candidate->specialisation_1 ?? '' }}" class="form-control  uppercase-text"
                        name="specialisation_1"></div>
            </div>
        @endif
    @endif

    <div class="col-lg-4">
        <div class="form-group position_applied_2">

            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->position_applied_for_2 ?? '' }}" name="position_applied_for_2" placeholder=""> --}}
            @if ($candidate->positionAppliedFor2)
                @if ($candidate->positionAppliedFor2()->where('is_active', 1)->count() > 0)
                    <label for="">Position Applied For(2) <span>* </span> <span><a href="javascript:void(0);"
                                class="position_applied_for_2">Other</a></span></label>
                    <select name="position_applied_for_2"
                        class="form-select  uppercase-text select2 positionAppliedFor2" id="">
                        <option value="">Select Position</option>
                        @foreach ($candidate_positions as $item)
                            <option value="{{ $item['id'] }}"
                                {{ $candidate->position_applied_for_2 == $item['id'] ? 'selected' : '' }}>
                                {{ $item['name'] }}</option>
                        @endforeach
                    </select>
                @else
                    <label for="">Position Applied For(2) <span>* </span> <span><a href="javascript:void(0);"
                                class="position_applied_for_2">List</a></span></label>
                    <input type="text" class="form-control  uppercase-text" id=""
                        value="{{ $candidate->positionAppliedFor2->name ?? '' }}" name="position_applied_for_2"
                        placeholder="">
                @endif
            @else
                <label for="">Position Applied For(2) <span>* </span> <span><a href="javascript:void(0);"
                            class="position_applied_for_2">Other</a></span></label>
                <select name="position_applied_for_2" class="form-select  uppercase-text select2 positionAppliedFor2"
                    id="">
                    <option value="">Select Position</option>
                    @foreach ($candidate_positions as $item)
                        <option value="{{ $item['id'] }}"
                            {{ $candidate->position_applied_for_2 == $item['id'] ? 'selected' : '' }}>
                            {{ $item['name'] }}</option>
                    @endforeach
                </select>
            @endif

        </div>
    </div>
    @if ($candidate->positionAppliedFor2)
        @if ($candidate->positionAppliedFor2()->where('is_active', 1)->count() > 0)
            <div class="col-lg-4 specialisation_2">
                <div class="form-group "><label>Specialisation for Position (2)</label><input type="text"
                        value="{{ $candidate->specialisation_2 ?? '' }}" class="form-control  uppercase-text"
                        name="specialisation_2"></div>
            </div>
        @endif
    @endif
    <div class="col-lg-4">
        <div class="form-group position_applied_3">

            {{-- <input type="text" class="form-control  uppercase-text" id=""
                    value="{{ $candidate->position_applied_for_3 ?? '' }}" name="position_applied_for_3" placeholder=""> --}}
            @if ($candidate->positionAppliedFor3)
                @if ($candidate->positionAppliedFor3()->where('is_active', 1)->count() > 0)
                    <label for="">Position Applied For(3) <span><a href="javascript:void(0);"
                                class="position_applied_for_3">Other</a></span></label>
                    <select name="position_applied_for_3"
                        class="form-select  uppercase-text select2 positionAppliedFor3" id="">
                        <option value="">Select Position</option>
                        @foreach ($candidate_positions as $item)
                            <option value="{{ $item['id'] }}"
                                {{ $candidate->position_applied_for_3 == $item['id'] ? 'selected' : '' }}>
                                {{ $item['name'] }}</option>
                        @endforeach
                    </select>
                @else
                    <label for="">Position Applied For(3) <span><a href="javascript:void(0);"
                                class="position_applied_for_3">List</a></span></label>
                    <input type="text" class="form-control  uppercase-text" id=""
                        value="{{ $candidate->positionAppliedFor3->name ?? '' }}" name="position_applied_for_3"
                        placeholder="">
                @endif
            @else
                <label for="">Position Applied For(3) <span><a href="javascript:void(0);"
                            class="position_applied_for_3">Other</a></span></label>
                <select name="position_applied_for_3" class="form-select  uppercase-text select2 positionAppliedFor3"
                    id="">
                    <option value="">Select Position</option>
                    @foreach ($candidate_positions as $item)
                        <option value="{{ $item['id'] }}"
                            {{ $candidate->position_applied_for_3 == $item['id'] ? 'selected' : '' }}>
                            {{ $item['name'] }}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>
    @if ($candidate->positionAppliedFor3)
        @if ($candidate->positionAppliedFor3()->where('is_active', 1)->count() > 0)
            <div class="col-lg-4 specialisation_3">
                <div class="form-group "><label>Specialisation for Position (3)</label><input type="text"
                        value="{{ $candidate->specialisation_3 ?? '' }}" class="form-control  uppercase-text"
                        name="specialisation_3"></div>
            </div>
        @endif
    @endif

    {{-- <div class="col-lg-4">
        <div class="form-group">
            <label for="">Last Update Date</label>
            <input type="date" class="form-control  uppercase-text" id=""
                value="{{ $candidate->last_update_date ?? '' }}" name="last_update_date" placeholder="">
        </div>
    </div> --}}

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Status <span>*</span></label>
            <select name="cnadidate_status_id" class="form-select  uppercase-text" id="">
                <option value="">Select A Status</option>
                @foreach ($candidate_statuses as $status)
                    <option value="{{ $status->id }}"
                        {{ $candidate->cnadidate_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('cnadidate_status_id'))
                <span class="text-danger">{{ $errors->first('cnadidate_status_id') }}</span>
            @endif
        </div>
    </div>

    <div class="col-lg-4">

    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Remarks</label>
            <textarea class="form-control  uppercase-text" id="" rows="3" name="remark">{{ $candidate->lastCandidateActivity->remarks ?? '' }}</textarea>
        </div>
    </div>
@else
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Full Name <span>*</span></label>
            <input type="text" class="form-control  uppercase-text " id=""
                value="{{ old('full_name') }}" name="full_name" placeholder="">
            @if ($errors->has('full_name'))
                <span class="text-danger">{{ $errors->first('full_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Email </label>
            <input type="text" class="form-control  uppercase-text" id="" value="{{ old('email') }}"
                name="email" placeholder="">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Alternative Contact NO: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="alternate_contact_no"
                value="{{ old('alternate_contact_no') }}" placeholder="">
            @if ($errors->has('alternate_contact_no'))
                @error('alternate_contact_no')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Whatsapp NO: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="whatapp_no"
                value="{{ old('whatapp_no') }}" placeholder="">
            @if ($errors->has('whatapp_no'))
                @error('whatapp_no')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Passport Number: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="passport_number"
                value="{{ old('passport_number') }}" placeholder="">
            @if ($errors->has('passport_number'))
                @error('passport_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">City: </label>
            <select name="city" class="form-select select2 uppercase-text" id="">
                <option value="">Select City</option>
                @foreach (Position::getCity() as $city)
                    <option value="{{ $city }}" {{ old('city') == $city ? 'selected' : '' }}>{{ $city }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gender</label>
            <select name="gender" class="form-select  uppercase-text" id="">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">DOB </label>
            <input type="date" class="form-control  uppercase-text" id="" value="{{ old('dob') }}"
                name="dob" max="{{ date('Y-m-d') }}" placeholder="">
        </div>
        @if ($errors->has('dob'))
            <span class="text-danger">{{ $errors->first('dob') }}</span>
        @endif
    </div>
    {{-- <div class="col-lg-4">
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" class="form-control  uppercase-text" id="" value="{{ old('age') }}" name="age"
                placeholder="">
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Education</label>
            <select name="education" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="5th Pass" @if (old('education') == '5th Pass') selected @endif>5th Pass</option>
                <option value="8th Pass" @if (old('education') == '8th Pass') selected @endif>8th Pass</option>
                <option value="10th Pass" @if (old('education') == '10th Pass') selected @endif>10th Pass </option>
                <option value="Higher Secondary" @if (old('education') == 'Higher Secondary') selected @endif>Higher
                    Secondary</option>
                <option value="Graduates" @if (old('education') == 'Graduates') selected @endif>Graduates</option>
                <option value="Masters" @if (old('education') == 'Masters') selected @endif>Masters</option>
            </select>
            {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ old('education') }}"
                name="education" placeholder=""> --}}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Other Education</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ old('other_education') }}" name="other_education" placeholder="">
        </div>
    </div>

    {{-- Mode of Registration --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Mode of Registration</label>
            {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ old('mode_of_registration') }}"
                name="mode_of_registration" placeholder=""> --}}
            <select name="mode_of_registration" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Calling" @if (old('mode_of_registration') == 'Calling') selected @endif>Calling</option>
                <option value="Walk-in" @if (old('mode_of_registration') == 'Walk-in') selected @endif>Walk-in</option>
            </select>
        </div>
    </div>
    {{-- Source --}}

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Source</label>
            <select name="source" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Telecalling" @if (old('source') == 'Telecalling') selected @endif>Telecalling</option>
                <option value="Reference" @if (old('source') == 'Reference') selected @endif>Reference</option>
                <option value="Facebook" @if (old('source') == 'Facebook') selected @endif>Facebook</option>
                <option value="Instagram" @if (old('source') == 'Instagram') selected @endif>Instagram</option>
                <option value="Others" @if (old('source') == 'Others') selected @endif>Others </option>
            </select>
            {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ old('source') }}" name="source"
                placeholder=""> --}}
        </div>
    </div>

    {{-- referred_by --}}

    <div class="col-lg-4">
        <div class="form-group referred_by_id" id="">
            <label for="">Referred by <span><a href="javascript:void(0);"
                        class="referred_type">Other</a></span></label>
            <select name="referred_by_id" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                @foreach ($associates as $item)
                    <option value="{{ $item['id'] }}">{{ $item['full_name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Religion: </label>
            <select name="religion" class="form-select  uppercase-text" id="">
                <option value="">Select Religion</option>
                <option value="Hindu">Hindu</option>
                <option value="Islam">Islam</option>
                <option value="Christian">Christian</option>
                <option value="Sikh">Sikh</option>
                <option value="Buddhist">Buddhist</option>
                <option value="Jain">Jain</option>
                < <option value="Other">Other</option>
            </select>
            {{-- <input type="text" class="form-control  uppercase-text" id="" name="religion"
                value="{{ old('religion') }}" placeholder=""> --}}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label>Indian Driving License:</label>
            <select name="indian_driving_license[]" class="form-select  uppercase-text select2" id=""
                multiple>
                <option value="" disabled>Select Indian Driving License</option>
                <option value="2 WHEELER"
                    {{ in_array('2 WHEELER', old('indian_driving_license') ?? []) ? 'selected' : '' }}>
                    2 WHEELER</option>
                <option value="4 WHEELER"
                    {{ in_array('4 WHEELER', old('indian_driving_license') ?? []) ? 'selected' : '' }}>
                    4 WHEELER</option>
                <option value="HV" {{ in_array('HV', old('indian_driving_license') ?? []) ? 'selected' : '' }}>HV
                </option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gulf Driving License: </label>
            {{-- <input type="text" class="form-control  uppercase-text" id="" name="international_driving_license"
                value="{{ old('international_driving_license') }}" placeholder=""> --}}
            <select name="international_driving_license[]" class="form-select  uppercase-text select2" id=""
                multiple>
                <option value="" disabled>Select Gulf Driving License</option>
                <option value="2 WHEELER"
                    {{ in_array('2 WHEELER', old('international_driving_license') ?? []) ? 'selected' : '' }}>
                    2 WHEELER</option>
                <option value="4 WHEELER"
                    {{ in_array('4 WHEELER', old('international_driving_license') ?? []) ? 'selected' : '' }}>
                    4 WHEELER</option>
                <option value="HV"
                    {{ in_array('HV', old('international_driving_license') ?? []) ? 'selected' : '' }}>HV</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">English Speak</label>
            <select name="english_speak" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Basic" {{ old('english_speak') == 'Basic' ? 'selected' : '' }}>Basic</option>
                <option value="Good" {{ old('english_speak') == 'Good' ? 'selected' : '' }}>Good</option>
                <option value="Poor" {{ old('english_speak') == 'Poor' ? 'selected' : '' }}>Poor</option>
                <option value="NO" {{ old('english_speak') == 'NO' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Arabic Speak</label>
            <select name="arabic_speak" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="Basic" {{ old('english_speak') == 'Basic' ? 'selected' : '' }}>Basic</option>
                <option value="Good" {{ old('english_speak') == 'Good' ? 'selected' : '' }}>Good</option>
                <option value="Poor" {{ old('english_speak') == 'Poor' ? 'selected' : '' }}>Poor</option>
                <option value="NO" {{ old('english_speak') == 'NO' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gulf Return</label>
            <select name="return" class="form-select  uppercase-text" id="">
                <option value="">Select Gulf Return Type</option>
                <option value="1" {{ old('return') == '1' ? 'selected' : '' }}>YES</option>
                <option value="0" {{ old('return') == '0' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">ECR Type</label>
            <select name="ecr_type" class="form-select  uppercase-text" id="">
                <option value="">Select ECR</option>
                <option value="ECR" {{ old('ecr_type') == 'ECR' ? 'selected' : '' }}>ECR</option>
                <option value="ECNR" {{ old('ecr_type') == 'ECNR' ? 'selected' : '' }}>ECNR</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Work Experience (If Any?)</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ old('indian_exp') }}" name="indian_exp" placeholder="">
            @if ($errors->has('indian_exp'))
                @error('indian_exp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Abroad Work Experience (If Any?)</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ old('abroad_exp') }}" name="abroad_exp" placeholder="">

        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group position_applied_1">
            <label for="">Position Applied For(1) <span>*</span> <span><a href="javascript:void(0);"
                        class="position_applied_for_1">Other</a></span></label>
            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->position_applied_for_1 ?? '' }}" name="position_applied_for_1" placeholder=""> --}}
            <select name="position_applied_for_1" class="form-select  uppercase-text select2 positionAppliedFor1"
                id="">
                <option value="">Select Position</option>
                @foreach ($candidate_positions as $item)
                    <option value="{{ $item['id'] }}"
                        {{ old('position_applied_for_1') == $item['id'] ? 'selected' : '' }}>
                        {{ $item['name'] }}</option>
                @endforeach
            </select>
            @if ($errors->has('position_applied_for_1'))
                @error('position_applied_for_1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group position_applied_2">
            <label for="">Position Applied For(2) <span><a href="javascript:void(0);"
                        class="position_applied_for_2">Other</a></span></label>
            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->position_applied_for_2 ?? '' }}" name="position_applied_for_2" placeholder=""> --}}
            <select name="position_applied_for_2" class="form-select  uppercase-text select2 positionAppliedFor2"
                id="">
                <option value="">Select Position</option>
                @foreach ($candidate_positions as $item)
                    <option value="{{ $item['id'] }}"
                        {{ old('position_applied_for_2') == $item['id'] ? 'selected' : '' }}>
                        {{ $item['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group position_applied_3">
            <label for="">Position Applied For(3) <span><a href="javascript:void(0);"
                        class="position_applied_for_3">Other</a></span></label>
            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->position_applied_for_3 ?? '' }}" name="position_applied_for_3" placeholder=""> --}}
            <select name="position_applied_for_3" class="form-select  uppercase-text select2 positionAppliedFor3"
                id="">
                <option value="">Select Position</option>
                @foreach ($candidate_positions as $item)
                    <option value="{{ $item['id'] }}"
                        {{ old('position_applied_for_3') == $item['id'] ? 'selected' : '' }}>
                        {{ $item['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- <div class="col-lg-4">
        <div class="form-group">
            <label for="">Last Update Date</label>
            <input type="date" class="form-control  uppercase-text" id="" value="{{ old('last_update_date') }}"
                name="last_update_date" placeholder="">
        </div>
    </div> --}}

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Status<span>*</span></label>
            <select name="cnadidate_status_id" class="form-select  uppercase-text" id="">
                <option value="">Select A Status</option>
                @foreach ($candidate_statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('cnadidate_status_id'))
                @error('cnadidate_status_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>

    <div class="col-lg-4">

    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Remarks</label>
            <textarea class="form-control  uppercase-text" id="" rows="3" name="remark">{{ old('remark') }}</textarea>
        </div>
    </div>
@endif


<script>
    $(document).ready(function() {
        $('.select2').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        })


    });
</script>
