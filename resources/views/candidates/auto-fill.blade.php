@if (isset($autofill))
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Full Name <span>*</span></label>
            <input type="text" class="form-control" id="" value="{{ $candidate->full_name ?? '' }}"
                name="full_name" placeholder="">
            @if ($errors->has('full_name'))
                <span class="text-danger">{{ $errors->first('full_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Email <span>*</span></label>
            <input type="text" class="form-control" id="" value="{{ $candidate->email ?? '' }}"
                name="email" placeholder="">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
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
            <select name="city" class="form-select" id="">
                <option value="">Select City</option>
                <option value="Mumbai" {{ $candidate->city == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                <option value="Delhi" {{ $candidate->city == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                <option value="Kolkata" {{ $candidate->city == 'Kolkata' ? 'selected' : '' }}>Kolkata</option>
                <option value="Chennai" {{ $candidate->city == 'Chennai' ? 'selected' : '' }}>Chennai</option>
                <option value="Bangalore" {{ $candidate->city == 'Bangalore' ? 'selected' : '' }}>Bangalore</option>
                <option value="Hyderabad" {{ $candidate->city == 'Hyderabad' ? 'selected' : '' }}>Hyderabad</option>
                <option value="Ahmedabad" {{ $candidate->city == 'Ahmedabad' ? 'selected' : '' }}>Ahmedabad</option>
                <option value="Pune" {{ $candidate->city == 'Pune' ? 'selected' : '' }}>Pune</option>
                <option value="Surat" {{ $candidate->city == 'Surat' ? 'selected' : '' }}>Surat</option>
                <option value="Jaipur" {{ $candidate->city == 'Jaipur' ? 'selected' : '' }}>Jaipur</option>
                <option value="Kanpur" {{ $candidate->city == 'Kanpur' ? 'selected' : '' }}>Kanpur</option>
                <option value="Nagpur" {{ $candidate->city == 'Nagpur' ? 'selected' : '' }}>Nagpur</option>
                <option value="Lucknow" {{ $candidate->city == 'Lucknow' ? 'selected' : '' }}>Lucknow</option>
                <option value="Thane" {{ $candidate->city == 'Thane' ? 'selected' : '' }}>Thane</option>
                <option value="Bhopal" {{ $candidate->city == 'Bhopal' ? 'selected' : '' }}>Bhopal</option>
                <option value="Visakhapatnam" {{ $candidate->city == 'Visakhapatnam' ? 'selected' : '' }}>Visakhapatnam
                </option>
                <option value="Pimpri-Chinchwad" {{ $candidate->city == 'Pimpri-Chinchwad' ? 'selected' : '' }}>
                    Pimpri-Chinchwad</option>
                <option value="Patna" {{ $candidate->city == 'Patna' ? 'selected' : '' }}>Patna</option>
                <option value="Vadodara" {{ $candidate->city == 'Vadodara' ? 'selected' : '' }}>Vadodara</option>
                <option value="Ghaziabad" {{ $candidate->city == 'Ghaziabad' ? 'selected' : '' }}>Ghaziabad</option>
                <option value="Ludhiana" {{ $candidate->city == 'Ludhiana' ? 'selected' : '' }}>Ludhiana</option>
                <option value="Agra" {{ $candidate->city == 'Agra' ? 'selected' : '' }}>Agra</option>
                <option value="Nashik" {{ $candidate->city == 'Nashik' ? 'selected' : '' }}>Nashik</option>
                <option value="Faridabad" {{ $candidate->city == 'Faridabad' ? 'selected' : '' }}>Faridabad</option>
                <option value="Meerut" {{ $candidate->city == 'Meerut' ? 'selected' : '' }}>Meerut</option>
                <option value="Rajkot" {{ $candidate->city == 'Rajkot' ? 'selected' : '' }}>Rajkot</option>
                <option value="Kalyan-Dombivali" {{ $candidate->city == 'Kalyan-Dombivali' ? 'selected' : '' }}>
                    Kalyan-Dombivali</option>
                <option value="Vasai-Virar" {{ $candidate->city == 'Vasai-Virar' ? 'selected' : '' }}>Vasai-Virar
                </option>
                <option value="Varanasi" {{ $candidate->city == 'Varanasi' ? 'selected' : '' }}>Varanasi</option>
                <option value="Srinagar" {{ $candidate->city == 'Srinagar' ? 'selected' : '' }}>Srinagar</option>
                <option value="Aurangabad" {{ $candidate->city == 'Aurangabad' ? 'selected' : '' }}>Aurangabad</option>
                <option value="Dhanbad" {{ $candidate->city == 'Dhanbad' ? 'selected' : '' }}>Dhanbad</option>
            </select>
            {{-- <input type="text" class="form-control" id="" name="city"
                value="{{ $candidate->city ?? '' }}" placeholder=""> --}}
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gender</label>
            <select name="gender" class="form-select" id="">
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
            <input type="date" class="form-control" id=""
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
            <input type="text" class="form-control" id="" value="{{ $candidate->age ?? '' }}"
                name="age" placeholder="">
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Education</label>
            {{-- <input type="text" class="form-control" id="" value="{{ $candidate->education ?? '' }}"
                name="education" placeholder=""> --}}
            <select name="education" class="form-select" id="">
                <option value="">Select Type</option>
                <option value="5th Pass" {{ $candidate->education == '5th Pass' ? 'selected' : '' }}>5th Pass</option>
                <option value="8th Pass" {{ $candidate->education == '8th Pass' ? 'selected' : '' }}>8th Pass</option>
                <option value="10th Pass" {{ $candidate->education == '10th Pass' ? 'selected' : '' }}>10th Pass
                </option>
                <option value="Higher Secondary Graduates"
                    {{ $candidate->education == 'Higher Secondary Graduates' ? 'selected' : '' }}>Higher Secondary
                    Graduates</option>
                <option value="BBA" {{ $candidate->education == 'BBA' ? 'selected' : '' }}>BBA</option>
                <option value="MBA" {{ $candidate->education == 'MBA' ? 'selected' : '' }}>MBA</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Other Education</label>
            <input type="text" class="form-control" id=""
                value="{{ $candidate->other_education ?? '' }}" name="other_education" placeholder="">
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
            {{-- <input type="text" class="form-control" id="" value="{{ $candidate->source ?? '' }}"
                name="source" placeholder=""> --}}
            <select name="source" class="form-select" id="">
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
                <select name="referred_by_id" class="form-select" id="">
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
                <input type="text" class="form-control" id=""
                    value="{{ $candidate->referred_by ?? '' }}" name="referred_by" placeholder="">
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Religion: </label>
            <select name="religion" class="form-select" id="">
                <option value="">Select Religion</option>
                <option value="Hindu" {{ $candidate->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Muslim" {{ $candidate->religion == 'Muslim' ? 'selected' : '' }}>Muslim</option>
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
            <select name="english_speak" class="form-select" id="">
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
            <select name="arabic_speak" class="form-select" id="">
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
            <label for="">Gulf Return</label>
            <select name="return" class="form-select" id="">
                <option value="">Select Gulf Return </option>
                <option value="1" {{ $candidate->return == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $candidate->return == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">ECR Type</label>
            <select name="ecr_type" class="form-select" id="">
                <option value="">Select ECR</option>
                <option value="ECR" {{ $candidate->ecr_type == 'ECR' ? 'selected' : '' }}>ECR</option>
                <option value="ENCR" {{ $candidate->ecr_type == 'ENCR' ? 'selected' : '' }}>ENCR</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Work Experience (If Any?)</label>
            {{-- <input type="text" class="form-control" id="" value="{{ $candidate->indian_exp ?? '' }}"
                name="indian_exp" placeholder=""> --}}
            <select name="indian_exp" class="form-select" id="">
                <option value="">Select Indian Experience</option>
                <option value="1 Year Experience" {{ $candidate->indian_exp == '1 Year Experience' ? 'selected' : '' }}>
                    1 Year Experience</option>
                <option value="2 Year Experience" {{ $candidate->indian_exp == '2 Year Experience' ? 'selected' : '' }}>
                    2 Year Experience</option>
                <option value="3 Year Experience" {{ $candidate->indian_exp == '3 Year Experience' ? 'selected' : '' }}>
                    3 Year Experience</option>
                <option value="4 Year Experience" {{ $candidate->indian_exp == '4 Year Experience' ? 'selected' : '' }}>
                    4 Year Experience</option>
                <option value="5 Year Experience" {{ $candidate->indian_exp == '5 Year Experience' ? 'selected' : '' }}>
                    5 Year Experience</option>
                <option value="6 Year Experience" {{ $candidate->indian_exp == '6 Year Experience' ? 'selected' : '' }}>
                    6 Year Experience</option>
                <option value="7 Year Experience" {{ $candidate->indian_exp == '7 Year Experience' ? 'selected' : '' }}>
                    7 Year Experience</option>
                <option value="8 Year Experience" {{ $candidate->indian_exp == '8 Year Experience' ? 'selected' : '' }}>
                    8 Year Experience</option>
                <option value="9 Year Experience" {{ $candidate->indian_exp == '9 Year Experience' ? 'selected' : '' }}>
                    9 Year Experience</option>
                <option value="10 Year Experience"
                    {{ $candidate->indian_exp == '10 Year Experience' ? 'selected' : '' }}>10 Year Experience</option>
                <option value="11 Year Experience"
                    {{ $candidate->indian_exp == '11 Year Experience' ? 'selected' : '' }}>11 Year Experience</option>
                <option value="12 Year Experience"
                    {{ $candidate->indian_exp == '12 Year Experience' ? 'selected' : '' }}>12 Year Experience</option>
                <option value="13 Year Experience"
                    {{ $candidate->indian_exp == '13 Year Experience' ? 'selected' : '' }}>13 Year Experience</option>
                <option value="14 Year Experience"
                    {{ $candidate->indian_exp == '14 Year Experience' ? 'selected' : '' }}>14 Year Experience</option>
                <option value="15 Year Experience"
                    {{ $candidate->indian_exp == '15 Year Experience' ? 'selected' : '' }}>15 Year Experience</option>
                <option value="16 Year Experience"
                    {{ $candidate->indian_exp == '16 Year Experience' ? 'selected' : '' }}>16 Year Experience</option>
                <option value="17 Year Experience"
                    {{ $candidate->indian_exp == '17 Year Experience' ? 'selected' : '' }}>17 Year Experience</option>
                <option value="18 Year Experience"
                    {{ $candidate->indian_exp == '18 Year Experience' ? 'selected' : '' }}>18 Year Experience</option>
                <option value="19 Year Experience"
                    {{ $candidate->indian_exp == '19 Year Experience' ? 'selected' : '' }}>19 Year Experience</option>
                <option value="20 Year Experience"
                    {{ $candidate->indian_exp == '20 Year Experience' ? 'selected' : '' }}>20 Year Experience</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Abroad Work Experience (If Any?)</label>
            {{-- <input type="text" class="form-control" id="" value="{{ $candidate->abroad_exp ?? '' }}"
                name="abroad_exp" placeholder=""> --}}
                <select name="abroad_exp" class="form-select" id="">
                    <option value="">Select Abroad Experience</option>
                    <option value="1 Year Experience" {{ $candidate->abroad_exp == '1 Year Experience' ? 'selected' : '' }}>
                        1 Year Experience</option>
                    <option value="2 Year Experience" {{ $candidate->abroad_exp == '2 Year Experience' ? 'selected' : '' }}>
                        2 Year Experience</option>
                    <option value="3 Year Experience" {{ $candidate->abroad_exp == '3 Year Experience' ? 'selected' : '' }}>
                        3 Year Experience</option>
                    <option value="4 Year Experience" {{ $candidate->abroad_exp == '4 Year Experience' ? 'selected' : '' }}>
                        4 Year Experience</option>
                    <option value="5 Year Experience" {{ $candidate->abroad_exp == '5 Year Experience' ? 'selected' : '' }}>
                        5 Year Experience</option>
                    <option value="6 Year Experience" {{ $candidate->abroad_exp == '6 Year Experience' ? 'selected' : '' }}>
                        6 Year Experience</option>
                    <option value="7 Year Experience" {{ $candidate->abroad_exp == '7 Year Experience' ? 'selected' : '' }}>
                        7 Year Experience</option>
                    <option value="8 Year Experience" {{ $candidate->abroad_exp == '8 Year Experience' ? 'selected' : '' }}>
                        8 Year Experience</option>
                    <option value="9 Year Experience" {{ $candidate->abroad_exp == '9 Year Experience' ? 'selected' : '' }}>
                        9 Year Experience</option>
                    <option value="10 Year Experience"
                        {{ $candidate->abroad_exp == '10 Year Experience' ? 'selected' : '' }}>10 Year Experience</option>
                    <option value="11 Year Experience"
                        {{ $candidate->abroad_exp == '11 Year Experience' ? 'selected' : '' }}>11 Year Experience</option>
                    <option value="12 Year Experience"
                        {{ $candidate->abroad_exp == '12 Year Experience' ? 'selected' : '' }}>12 Year Experience</option>
                    <option value="13 Year Experience"
                        {{ $candidate->abroad_exp == '13 Year Experience' ? 'selected' : '' }}>13 Year Experience</option>
                    <option value="14 Year Experience"
                        {{ $candidate->abroad_exp == '14 Year Experience' ? 'selected' : '' }}>14 Year Experience</option>
                    <option value="15 Year Experience"
                        {{ $candidate->abroad_exp == '15 Year Experience' ? 'selected' : '' }}>15 Year Experience</option>
                    <option value="16 Year Experience"
                        {{ $candidate->abroad_exp == '16 Year Experience' ? 'selected' : '' }}>16 Year Experience</option>
                    <option value="17 Year Experience"
                        {{ $candidate->abroad_exp == '17 Year Experience' ? 'selected' : '' }}>17 Year Experience</option>
                    <option value="18 Year Experience"
                        {{ $candidate->abroad_exp == '18 Year Experience' ? 'selected' : '' }}>18 Year Experience</option>
                    <option value="19 Year Experience"
                        {{ $candidate->abroad_exp == '19 Year Experience' ? 'selected' : '' }}>19 Year Experience</option>
                    <option value="20 Year Experience"
                        {{ $candidate->abroad_exp == '20 Year Experience' ? 'selected' : '' }}>20 Year Experience</option>
                </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For(1)</label>
            {{-- <input type="text" class="form-control" id=""
                value="{{ $candidate->position_applied_for_1 ?? '' }}" name="position_applied_for_1" placeholder=""> --}}
            <select name="position_applied_for_1" class="form-select" id="">
                <option value="">Select Position</option>
                <option value="Driver" {{ $candidate->position_applied_for_1 == 'Driver' ? 'selected' : '' }}>Driver
                </option>
                <option value="Housemaid" {{ $candidate->position_applied_for_1 == 'Housemaid' ? 'selected' : '' }}>
                    Housemaid</option>
                <option value="Nanny" {{ $candidate->position_applied_for_1 == 'Nanny' ? 'selected' : '' }}>Nanny
                </option>
                <option value="Baby Sitter"
                    {{ $candidate->position_applied_for_1 == 'Baby Sitter' ? 'selected' : '' }}>Baby Sitter</option>
                <option value="Cook" {{ $candidate->position_applied_for_1 == 'Cook' ? 'selected' : '' }}>Cook
                </option>
                <option value="Patient Care"
                    {{ $candidate->position_applied_for_1 == 'Patient Care' ? 'selected' : '' }}>Patient Care</option>
                <option value="Nurse" {{ $candidate->position_applied_for_1 == 'Nurse' ? 'selected' : '' }}>Nurse
                </option>
            </select>

        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For(2)</label>
            <select name="position_applied_for_2" class="form-select" id="">
                <option value="">Select Position</option>
                <option value="Driver" {{ $candidate->position_applied_for_2 == 'Driver' ? 'selected' : '' }}>Driver
                </option>
                <option value="Housemaid" {{ $candidate->position_applied_for_2 == 'Housemaid' ? 'selected' : '' }}>
                    Housemaid</option>
                <option value="Nanny" {{ $candidate->position_applied_for_2 == 'Nanny' ? 'selected' : '' }}>Nanny
                </option>
                <option value="Baby Sitter"
                    {{ $candidate->position_applied_for_2 == 'Baby Sitter' ? 'selected' : '' }}>Baby Sitter</option>
                <option value="Cook" {{ $candidate->position_applied_for_2 == 'Cook' ? 'selected' : '' }}>Cook
                </option>
                <option value="Patient Care"
                    {{ $candidate->position_applied_for_2 == 'Patient Care' ? 'selected' : '' }}>Patient Care</option>
                <option value="Nurse" {{ $candidate->position_applied_for_2 == 'Nurse' ? 'selected' : '' }}>Nurse
                </option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For(3)</label>
            <select name="position_applied_for_3" class="form-select" id="">
                <option value="">Select Position</option>
                <option value="Driver" {{ $candidate->position_applied_for_3 == 'Driver' ? 'selected' : '' }}>Driver
                </option>
                <option value="Housemaid" {{ $candidate->position_applied_for_3 == 'Housemaid' ? 'selected' : '' }}>
                    Housemaid</option>
                <option value="Nanny" {{ $candidate->position_applied_for_3 == 'Nanny' ? 'selected' : '' }}>Nanny
                </option>
                <option value="Baby Sitter"
                    {{ $candidate->position_applied_for_3 == 'Baby Sitter' ? 'selected' : '' }}>Baby Sitter</option>
                <option value="Cook" {{ $candidate->position_applied_for_3 == 'Cook' ? 'selected' : '' }}>Cook
                </option>
                <option value="Patient Care"
                    {{ $candidate->position_applied_for_3 == 'Patient Care' ? 'selected' : '' }}>Patient Care</option>
                <option value="Nurse" {{ $candidate->position_applied_for_3 == 'Nurse' ? 'selected' : '' }}>Nurse
                </option>
            </select>
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
            <select name="cnadidate_status_id" class="form-select" id="">
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
            <label for="">Email <span>*</span></label>
            <input type="text" class="form-control" id="" value="{{ old('email') }}" name="email"
                placeholder="">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
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
            <select name="city" class="form-select" id="">
                <option value="">Select City</option>
                <option value="Mumbai">Mumbai</option>
                <option value="Delhi">Delhi</option>
                <option value="Kolkata">Kolkata</option>
                <option value="Chennai">Chennai</option>
                <option value="Bangalore">Bangalore</option>
                <option value="Hyderabad">Hyderabad</option>
                <option value="Ahmedabad">Ahmedabad</option>
                <option value="Pune">Pune</option>
                <option value="Surat">Surat</option>
                <option value="Jaipur">Jaipur</option>
                <option value="Kanpur">Kanpur</option>
                <option value="Nagpur">Nagpur</option>
                <option value="Lucknow">Lucknow</option>
                <option value="Thane">Thane</option>
                <option value="Bhopal">Bhopal</option>
                <option value="Visakhapatnam">Visakhapatnam</option>
                <option value="Pimpri-Chinchwad">Pimpri-Chinchwad</option>
                <option value="Patna">Patna</option>
                <option value="Vadodara">Vadodara</option>
                <option value="Ghaziabad">Ghaziabad</option>
                <option value="Ludhiana">Ludhiana</option>
                <option value="Agra"> Agra</option>
                <option value="Nashik">Nashik</option>
                <option value="Faridabad">Faridabad</option>
                <option value="Meerut">Meerut</option>
                <option value="Rajkot">Rajkot</option>
                <option value="Kalyan-Dombivali">Kalyan-Dombivali</option>
                <option value="Vasai-Virar">Vasai-Virar</option>
                <option value="Varanasi">Varanasi</option>
                <option value="Srinagar">Srinagar</option>
                <option value="Aurangabad">Aurangabad</option>
                <option value="Dhanbad">Dhanbad</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Gender</label>
            <select name="gender" class="form-select" id="">
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
    {{-- <div class="col-lg-4">
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" class="form-control" id="" value="{{ old('age') }}" name="age"
                placeholder="">
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Education</label>
            <select name="education" class="form-select" id="">
                <option value="">Select Type</option>
                <option value="5th Pass">5th Pass</option>
                <option value="8th Pass">8th Pass</option>
                <option value="10th Pass">10th Pass</option>
                <option value="Higher Secondary Graduates">Higher Secondary Graduates</option>
                <option value="BBA">BBA</option>
                <option value="MBA">MBA</option>
            </select>
            {{-- <input type="text" class="form-control" id="" value="{{ old('education') }}"
                name="education" placeholder=""> --}}
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
            <select name="source" class="form-select" id="">
                <option value="">Select Type</option>
                <option value="Telecalling">Telecalling</option>
                <option value="Reference">Reference</option>
                <option value="Facebook">Facebook</option>
                <option value="Instagram">Instagram</option>
                <option value="Others">Others </option>
            </select>
            {{-- <input type="text" class="form-control" id="" value="{{ old('source') }}" name="source"
                placeholder=""> --}}
        </div>
    </div>

    {{-- referred_by --}}

    <div class="col-lg-4">
        <div class="form-group referred_by_id" id="">
            <label for="">Referred by <span><a href="javascript:void(0);"
                        class="referred_type">Other</a></span></label>
            <select name="referred_by_id" class="form-select" id="">
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
            <select name="religion" class="form-select" id="">
                <option value="">Select Religion</option>
                <option value="Hindu">Hindu</option>
                <option value="Muslim">Muslim</option>
                <option value="Christian">Christian</option>
                <option value="Sikh">Sikh</option>
                <option value="Buddhist">Buddhist</option>
                <option value="Jain">Jain</option>
                <option value="Other">Other</option>
            </select>
            {{-- <input type="text" class="form-control" id="" name="religion"
                value="{{ old('religion') }}" placeholder=""> --}}
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
            <select name="english_speak" class="form-select" id="">
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
            <select name="arabic_speak" class="form-select" id="">
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
            <label for="">Gulf Return</label>
            <select name="return" class="form-select" id="">
                <option value="">Select Gulf Return Type</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">ECR Type</label>
            <select name="ecr_type" class="form-select" id="">
                <option value="">Select ECR</option>
                <option value="ECR">ECR</option>
                <option value="ENCR">ENCR</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Indian Work Experience (If Any?)</label>
            {{-- <input type="text" class="form-control" id="" value="{{ old('indian_exp') }}"
                name="indian_exp" placeholder=""> --}}
            <select name="indian_exp" class="form-select" id="">
                <option value="">Select Indian Experience</option>
                <option value="1 Year Experience" {{ old('indian_exp') == '1 Year Experience' ? 'selected' : '' }}>1 Year Experience</option>
                <option value="2 Year Experience" {{ old('indian_exp') == '2 Year Experience' ? 'selected' : '' }}>2 Year Experience</option>
                <option value="3 Year Experience" {{ old('indian_exp') == '3 Year Experience' ? 'selected' : '' }}>3 Year Experience</option>
                <option value="4 Year Experience" {{ old('indian_exp') == '4 Year Experience' ? 'selected' : '' }}>4 Year Experience</option>
                <option value="5 Year Experience" {{ old('indian_exp') == '5 Year Experience' ? 'selected' : '' }}>5 Year Experience</option>
                <option value="6 Year Experience" {{ old('indian_exp') == '6 Year Experience' ? 'selected' : '' }}>6 Year Experience</option>
                <option value="7 Year Experience" {{ old('indian_exp') == '7 Year Experience' ? 'selected' : '' }}>7 Year Experience</option>
                <option value="8 Year Experience" {{ old('indian_exp') == '8 Year Experience' ? 'selected' : '' }}>8 Year Experience</option>
                <option value="9 Year Experience" {{ old('indian_exp') == '9 Year Experience' ? 'selected' : '' }}>9 Year Experience</option>
                <option value="10 Year Experience" {{ old('indian_exp') == '10 Year Experience' ? 'selected' : '' }}>10 Year Experience</option>
                <option value="11 Year Experience" {{ old('indian_exp') == '11 Year Experience' ? 'selected' : '' }}>11 Year Experience</option>
                <option value="12 Year Experience" {{ old('indian_exp') == '12 Year Experience' ? 'selected' : '' }}>12 Year Experience</option>
                <option value="13 Year Experience" {{ old('indian_exp') == '13 Year Experience' ? 'selected' : '' }}>13 Year Experience</option>
                <option value="14 Year Experience" {{ old('indian_exp') == '14 Year Experience' ? 'selected' : '' }}>14 Year Experience</option>
                <option value="15 Year Experience" {{ old('indian_exp') == '15 Year Experience' ? 'selected' : '' }}>15 Year Experience</option>
                <option value="16 Year Experience" {{ old('indian_exp') == '16 Year Experience' ? 'selected' : '' }}>16 Year Experience</option>
                <option value="17 Year Experience" {{ old('indian_exp') == '17 Year Experience' ? 'selected' : '' }}>17 Year Experience</option>
                <option value="18 Year Experience" {{ old('indian_exp') == '18 Year Experience' ? 'selected' : '' }}>18 Year Experience</option>
                <option value="19 Year Experience" {{ old('indian_exp') == '19 Year Experience' ? 'selected' : '' }}>19 Year Experience</option>
                <option value="20 Year Experience" {{ old('indian_exp') == '20 Year Experience' ? 'selected' : '' }}>20 Year Experience</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Abroad Work Experience (If Any?)</label>
            {{-- <input type="text" class="form-control" id="" value="{{ old('abroad_exp') }}"
                name="abroad_exp" placeholder=""> --}}
                <select name="abroad_exp" class="form-select" id="">
                    <option value="">Select Abroad Experience</option>
                    <option value="1 Year Experience" {{ old('abroad_exp') == '1 Year Experience' ? 'selected' : '' }}>1 Year Experience</option>
                    <option value="2 Year Experience" {{ old('abroad_exp') == '2 Year Experience' ? 'selected' : '' }}>2 Year Experience</option>
                    <option value="3 Year Experience" {{ old('abroad_exp') == '3 Year Experience' ? 'selected' : '' }}>3 Year Experience</option>
                    <option value="4 Year Experience" {{ old('abroad_exp') == '4 Year Experience' ? 'selected' : '' }}>4 Year Experience</option>
                    <option value="5 Year Experience" {{ old('abroad_exp') == '5 Year Experience' ? 'selected' : '' }}>5 Year Experience</option>
                    <option value="6 Year Experience" {{ old('abroad_exp') == '6 Year Experience' ? 'selected' : '' }}>6 Year Experience</option>
                    <option value="7 Year Experience" {{ old('abroad_exp') == '7 Year Experience' ? 'selected' : '' }}>7 Year Experience</option>
                    <option value="8 Year Experience" {{ old('abroad_exp') == '8 Year Experience' ? 'selected' : '' }}>8 Year Experience</option>
                    <option value="9 Year Experience" {{ old('abroad_exp') == '9 Year Experience' ? 'selected' : '' }}>9 Year Experience</option>
                    <option value="10 Year Experience" {{ old('abroad_exp') == '10 Year Experience' ? 'selected' : '' }}>10 Year Experience</option>
                    <option value="11 Year Experience" {{ old('abroad_exp') == '11 Year Experience' ? 'selected' : '' }}>11 Year Experience</option>
                    <option value="12 Year Experience" {{ old('abroad_exp') == '12 Year Experience' ? 'selected' : '' }}>12 Year Experience</option>
                    <option value="13 Year Experience" {{ old('abroad_exp') == '13 Year Experience' ? 'selected' : '' }}>13 Year Experience</option>
                    <option value="14 Year Experience" {{ old('abroad_exp') == '14 Year Experience' ? 'selected' : '' }}>14 Year Experience</option>
                    <option value="15 Year Experience" {{ old('abroad_exp') == '15 Year Experience' ? 'selected' : '' }}>15 Year Experience</option>
                    <option value="16 Year Experience" {{ old('abroad_exp') == '16 Year Experience' ? 'selected' : '' }}>16 Year Experience</option>
                    <option value="17 Year Experience" {{ old('abroad_exp') == '17 Year Experience' ? 'selected' : '' }}>17 Year Experience</option>
                    <option value="18 Year Experience" {{ old('abroad_exp') == '18 Year Experience' ? 'selected' : '' }}>18 Year Experience</option>
                    <option value="19 Year Experience" {{ old('abroad_exp') == '19 Year Experience' ? 'selected' : '' }}>19 Year Experience</option>
                    <option value="20 Year Experience" {{ old('abroad_exp') == '20 Year Experience' ? 'selected' : '' }}>20 Year Experience</option>
                </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For(1)</label>
            {{-- <input type="text" class="form-control" id=""
                value="{{ $candidate->position_applied_for_1 ?? '' }}" name="position_applied_for_1" placeholder=""> --}}
            <select name="position_applied_for_1" class="form-select" id="">
                <option value="">Select Position</option>
                <option value="Driver">Driver</option>
                <option value="Housemaid">Housemaid</option>
                <option value="Nanny">Nanny</option>
                <option value="Baby Sitter">Baby Sitter</option>
                <option value="Cook">Cook</option>
                <option value="Patient Care">Patient Care</option>
                <option value="Nurse">Nurse</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For(2)</label>
            <select name="position_applied_for_2" class="form-select" id="">
                <option value="">Select Position</option>
                <option value="Driver">Driver</option>
                <option value="Housemaid">Housemaid</option>
                <option value="Nanny">Nanny</option>
                <option value="Baby Sitter">Baby Sitter</option>
                <option value="Cook">Cook</option>
                <option value="Patient Care">Patient Care</option>
                <option value="Nurse">Nurse</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Position Applied For(3)</label>
            <select name="position_applied_for_3" class="form-select" id="">
                <option value="">Select Position</option>
                <option value="Driver">Driver</option>
                <option value="Housemaid">Housemaid</option>
                <option value="Nanny">Nanny</option>
                <option value="Baby Sitter">Baby Sitter</option>
                <option value="Cook">Cook</option>
                <option value="Patient Care">Patient Care</option>
                <option value="Nurse">Nurse</option>
            </select>
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
            <select name="cnadidate_status_id" class="form-select" id="">
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
