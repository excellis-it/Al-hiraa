@if (isset($autofill))
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Full Name <span>*</span></label>
            <input type="text" class="form-control" id="" value="{{ $candidate->full_name ?? '' }}" name="full_name"
                placeholder="">
            @if ($errors->has('full_name'))
                <span class="text-danger">{{ $errors->first('full_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Email <span></span></label>
            <input type="text" class="form-control" id="" value="{{ $candidate->email ?? '' }}"
                name="email" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Alternative Contact No: </label>
            <input type="text" class="form-control" id="" name="alternate_contact_no"
                value="{{ $candidate->alternate_contact_no ?? '' }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Whatsapp No: </label>
            <input type="text" class="form-control" id="" name="whatapp_no"
                value="{{ $candidate->whatapp_no ?? '' }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">City: </label>
            <input type="text" class="form-control" id="" name="city"
                value="{{ $candidate->city ?? '' }}" placeholder="">
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gender</label>
            <select name="gender" class="form-control" id="">
                <option value="">Select Gender</option>
                <option value="Male" {{ $candidate->gender == 'Male' ? 'selected' : '' }}> Male </option>
                <option value="Female" {{ $candidate->gender == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ $candidate->gender == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">DOB <span>*</span></label>
            <input type="date" class="form-control" id="" value="{{ date('Y-m-d',strtotime($candidate->date_of_birth)) ?? '' }}" name="dob"
                max="{{ date('Y-m-d') }}" placeholder="">
            @if ($errors->has('dob'))
                <span class="text-danger">{{ $errors->first('dob') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" class="form-control" id="" value="{{ $candidate->age ?? '' }}"
                name="age" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Education</label>
            <input type="text" class="form-control" id="" value="{{ $candidate->education ?? '' }}"
                name="education" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Other Education</label>
            <input type="text" class="form-control" id="" value="{{ $candidate->other_education ?? '' }}"
                name="other_education" placeholder="">
        </div>
    </div>

    {{-- Mode of Registration --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Mode of Registration</label>
            <input type="text" class="form-control" id=""
                value="{{ $candidate->mode_of_registration ?? '' }}" name="mode_of_registration" placeholder="">
        </div>
    </div>
    {{-- Source --}}

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Source</label>
            <input type="text" class="form-control" id="" value="{{ $candidate->source ?? '' }}"
                name="source" placeholder="">
        </div>
    </div>

    {{-- referred_by --}}

    <div class="col-lg-4">
        <div class="form-group referred_by_id" id="">

            @if ($candidate->referred_by_id != null)
                <label for="">Referred by <span><a href="javascript:void(0);"
                            class="referred_type">Other</a></span></label>
                <select name="referred_by_id" class="form-control" id="">
                    <option value="">Select Type</option>
                    @foreach ($associates as $item)
                        <option value="{{ $item['id'] }}"
                            {{ $candidate->referred_by_id == $item['id'] ? 'selected' : '' }}>{{ $item['full_name'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <label for="">Referred by <span><a href="javascript:void(0);"
                            class="referred_type">Associate</a></span></label>
                <input type="text" class="form-control" id="" value="{{ $candidate->referred_by ?? '' }}"
                    name="referred_by" placeholder="">
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Religion: </label>
            <input type="text" class="form-control" id="" name="religion"
                value="{{ $candidate->religion ?? '' }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Driving License: </label>
            <input type="text" class="form-control" id="" name="indian_driving_license"
                value="{{ $candidate->indian_driving_license ?? '' }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">International Driving License: </label>
            <input type="text" class="form-control" id="" name="international_driving_license"
                value="{{ $candidate->international_driving_license ?? '' }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">English Speak</label>
            <select name="english_speak" class="form-control" id="">
                <option value="">Select Type</option>
                <option value="Basic" {{ $candidate->english_speak == 'Basic' ? 'selected' : '' }}>Basic</option>
                <option value="Good" {{ $candidate->english_speak == 'Good' ? 'selected' : '' }}>Good</option>
                <option value="Poor" {{ $candidate->english_speak == 'Poor' ? 'selected' : '' }}>Poor</option>
                <option value="No" {{ $candidate->english_speak == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Arabic Speak</label>
            <select name="arabic_speak" class="form-control" id="">
                <option value="">Select Type</option>
                <option value="Basic" {{ $candidate->english_speak == 'Basic' ? 'selected' : '' }}>Basic</option>
                <option value="Good" {{ $candidate->english_speak == 'Good' ? 'selected' : '' }}>Good</option>
                <option value="Poor" {{ $candidate->english_speak == 'Poor' ? 'selected' : '' }}>Poor</option>
                <option value="No" {{ $candidate->english_speak == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Return</label>
            <select name="return" class="form-control" id="">
                <option value="">Select Return Type</option>
                <option value="1" {{ $candidate->return == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $candidate->return == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">ECR Type</label>
            <select name="ecr_type" class="form-control" id="">
                <option value="">Select ECR</option>
                <option value="ECR" {{ $candidate->ecr_type == 'ECR' ? 'selected' : '' }}>ECR</option>
                <option value="ENCR" {{ $candidate->ecr_type == 'ENCR' ? 'selected' : '' }}>ENCR</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position</label>
            <input type="text" class="form-control" id="" value="{{ $candidate->position ?? '' }}"
                name="position" placeholder="">
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Work Experience (If Any?)</label>
            <input type="text" class="form-control" id="" value="{{ $candidate->indian_exp ?? '' }}"
                name="indian_exp" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Abroad Work Experience (If Any?)</label>
            <input type="text" class="form-control" id="" value="{{ $candidate->abroad_exp ?? '' }}"
                name="abroad_exp" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For</label>
            <input type="text" class="form-control" id=""
                value="{{ $candidate->candidatePositions->name ?? '' }}" name="position_applied_for" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Last Update Date</label>
            <input type="date" class="form-control" id=""
                value="{{ $candidate->last_update_date ?? '' }}" name="last_update_date" placeholder="">
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Status <span>*</span></label>
            <select name="cnadidate_status_id" class="form-control" id="">
                <option value="">Select A Status</option>
                @foreach ($candidate_statuses as $status)
                    <option value="{{ $status->id }}"
                        {{ $candidate->cnadidate_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4">

    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Remarks</label>
            <textarea class="form-control" id="" rows="3" name="remark">{{ $candidate->remarks ?? '' }}</textarea>
        </div>
    </div>
@else
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Full Name <span>*</span></label>
            <input type="text" class="form-control" id="" value="{{ old('full_name') }}"
                name="full_name" placeholder="">
            @if ($errors->has('full_name'))
                <span class="text-danger">{{ $errors->first('full_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Email <span></span></label>
            <input type="text" class="form-control" id="" value="{{ old('email') }}" name="email"
                placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Alternative Contact No: </label>
            <input type="text" class="form-control" id="" name="alternate_contact_no"
                value="{{ old('alternate_contact_no') }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Whatsapp No: </label>
            <input type="text" class="form-control" id="" name="whatapp_no"
                value="{{ old('whatapp_no') }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">City: </label>
            <input type="text" class="form-control" id="" name="city" value="{{ old('city') }}"
                placeholder="">
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gender</label>
            <select name="gender" class="form-control" id="">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">DOB <span>*</span></label>
            <input type="date" class="form-control" id="" value="{{ old('dob') }}" name="dob"
                max="{{ date('Y-m-d') }}" placeholder="">
        </div>
        @if ($errors->has('dob'))
            <span class="text-danger">{{ $errors->first('dob') }}</span>
        @endif
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" class="form-control" id="" value="{{ old('age') }}" name="age"
                placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Education</label>
            <input type="text" class="form-control" id="" value="{{ old('education') }}"
                name="education" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Other Education</label>
            <input type="text" class="form-control" id="" value="{{ old('other_education') }}"
                name="other_education" placeholder="">
        </div>
    </div>

    {{-- Mode of Registration --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Mode of Registration</label>
            <input type="text" class="form-control" id="" value="{{ old('mode_of_registration') }}"
                name="mode_of_registration" placeholder="">
        </div>
    </div>
    {{-- Source --}}

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Source</label>
            <input type="text" class="form-control" id="" value="{{ old('source') }}" name="source"
                placeholder="">
        </div>
    </div>

    {{-- referred_by --}}

    <div class="col-lg-4">
        <div class="form-group referred_by_id" id="">
            <label for="">Referred by <span><a href="javascript:void(0);"
                        class="referred_type">Other</a></span></label>
            <select name="referred_by_id" class="form-control" id="">
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
            <input type="text" class="form-control" id="" name="religion"
                value="{{ old('religion') }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Driving License: </label>
            <input type="text" class="form-control" id="" name="indian_driving_license"
                value="{{ old('indian_driving_license') }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">International Driving License: </label>
            <input type="text" class="form-control" id="" name="international_driving_license"
                value="{{ old('international_driving_license') }}" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">English Speak</label>
            <select name="english_speak" class="form-control" id="">
                <option value="">Select Type</option>
                <option value="Basic">Basic</option>
                <option value="Good">Good</option>
                <option value="Poor">Poor</option>
                <option value="No">No</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Arabic Speak</label>
            <select name="arabic_speak" class="form-control" id="">
                <option value="">Select Type</option>
                <option value="Basic">Basic</option>
                <option value="Good">Good</option>
                <option value="Poor">Poor</option>
                <option value="No">No</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Return</label>
            <select name="return" class="form-control" id="">
                <option value="">Select Return Type</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">ECR Type</label>
            <select name="ecr_type" class="form-control" id="">
                <option value="">Select ECR</option>
                <option value="ECR">ECR</option>
                <option value="ENCR">ENCR</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position</label>
            <input type="text" class="form-control" id="" value="{{ old('position') }}"
                name="position" placeholder="">
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Work Experience (If Any?)</label>
            <input type="text" class="form-control" id="" value="{{ old('indian_exp') }}"
                name="indian_exp" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Abroad Work Experience (If Any?)</label>
            <input type="text" class="form-control" id="" value="{{ old('abroad_exp') }}"
                name="abroad_exp" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For</label>
            <input type="text" class="form-control" id="" value="{{ old('position_applied_for') }}"
                name="position_applied_for" placeholder="">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Last Update Date</label>
            <input type="date" class="form-control" id="" value="{{ old('last_update_date') }}"
                name="last_update_date" placeholder="">
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Status<span>*</span></label>
            <select name="cnadidate_status_id" class="form-control" id="">
                <option value="">Select A Status</option>
                @foreach ($candidate_statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4">

    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Remarks</label>
            <textarea class="form-control" id="" rows="3" name="remark">{{ old('remark') }}</textarea>
        </div>
    </div>

@endif
