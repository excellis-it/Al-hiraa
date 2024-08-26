@php
    use App\Constants\Position;
@endphp

@if (isset($autofill))
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Full Name <span>*</span></label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->full_name ?? '' }}" name="full_name" placeholder="">
            @if ($errors->has('full_name'))
                <span class="text-danger">{{ $errors->first('full_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->email ?? '' }}" name="email" placeholder="">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group date-btn">
            <label for="dob">DOB</label>
            <input type="text" class="form-control uppercase-text datepicker" id="dob"
                value="{{ \Carbon\Carbon::parse($candidate->date_of_birth)->format('d-m-Y') ?? '' }}" name="dob"
                max="{{ date('Y-m-d') }}" placeholder="dd-mm-yyyy">
           
        </div>
        @if ($errors->has('dob'))
        <span class="text-danger">{{ $errors->first('dob') }}</span>
    @endif
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Whatsapp NO: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="whatapp_no"
                value="{{ $candidate->whatapp_no ?? '' }}" placeholder="">
            @if ($errors->has('whatapp_no'))
                <span class="text-danger">{{ $errors->first('whatapp_no') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
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
    <div class="col-lg-3">
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

    <div class="col-lg-3">
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
            <div class="col-lg-3 specialisation_1">
                <div class="form-group "><label>Specialisation for Position (1)</label><input type="text"
                        value="{{ $candidate->specialisation_1 ?? '' }}" class="form-control  uppercase-text"
                        name="specialisation_1"></div>
            </div>
        @endif
    @endif

    <div class="col-lg-3">
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
            <div class="col-lg-3 specialisation_2">
                <div class="form-group "><label>Specialisation for Position (2)</label><input type="text"
                        value="{{ $candidate->specialisation_2 ?? '' }}" class="form-control  uppercase-text"
                        name="specialisation_2"></div>
            </div>
        @endif
    @endif
    <div class="col-lg-3">
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
            <div class="col-lg-3 specialisation_3">
                <div class="form-group "><label>Specialisation for Position (3)</label><input type="text"
                        value="{{ $candidate->specialisation_3 ?? '' }}" class="form-control  uppercase-text"
                        name="specialisation_3"></div>
            </div>
        @endif
    @endif

    <div class="col-lg-3">
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
    <div class="col-lg-3">
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

    <div class="col-lg-3">
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
    
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Passport Number: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="passport_number"
                value="{{ $candidate->passport_number ?? '' }}" placeholder="">
            @if ($errors->has('passport_number'))
                <span class="text-danger">{{ $errors->first('passport_number') }}</span>
            @endif
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group">
            <label for="">State: </label>
            <select name="state_id" class="form-select select2 uppercase-text" id="state_id">
                <option value="">SELECT STATE</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $candidate->state_id == $state->id ? 'selected' : '' }}>
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">City: </label>
            <select name="city" class="form-select select2 uppercase-text" id="">
                <option value="">SELECT CITY</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ $candidate->city == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control  uppercase-text" id="" name="city"
                value="{{ $candidate->city ?? '' }}" placeholder=""> --}}
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Gender</label>
            <select name="gender" class="form-select  uppercase-text" id="">
                <option value="">Select Gender</option>
                <option value="MALE" {{ $candidate->gender == 'MALE' ? 'selected' : '' }}> MALE </option>
                <option value="FEMALE" {{ $candidate->gender == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                <option value="OTHER" {{ $candidate->gender == 'OTHER' ? 'selected' : '' }}>OTHER</option>
            </select>
        </div>
    </div>
    
    {{-- <div class="col-lg-4">
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" class="form-control  uppercase-text" id="" value="{{ $candidate->age ?? '' }}"
                name="age" placeholder="">
        </div>
    </div> --}}
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Education</label>
            {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ $candidate->education ?? '' }}"
                name="education" placeholder=""> --}}
            <select name="education" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="5TH PASS" {{ $candidate->education == '5TH PASS' ? 'selected' : '' }}>5TH PASS</option>
                <option value="8TH PASS" {{ $candidate->education == '8TH PASS' ? 'selected' : '' }}>8TH PASS</option>
                <option value="10TH PASS" {{ $candidate->education == '10TH PASS' ? 'selected' : '' }}>10TH PASS
                </option>
                <option value="HIGHER SECONDARY" {{ $candidate->education == 'HIGHER SECONDARY' ? 'selected' : '' }}>
                    HIGHER SECONDARY
                </option>
                <option value="GRADUATES" {{ $candidate->education == 'GRADUATES' ? 'selected' : '' }}>GRADUATES
                </option>
                <option value="MASTERS" {{ $candidate->education == 'MASTERS' ? 'selected' : '' }}>MASTERS</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Other Education</label>
            <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->other_education ?? '' }}" name="other_education" placeholder="">
        </div>
    </div>

    {{-- Mode of Registration --}}
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Mode of Registration</label>
            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->mode_of_registration ?? '' }}" name="mode_of_registration" placeholder=""> --}}
            <select name="mode_of_registration" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="CALLING" {{ $candidate->mode_of_registration == 'CALLING' ? 'selected' : '' }}>CALLING
                </option>
                <option value="WALK-IN" {{ $candidate->mode_of_registration == 'WALK-IN' ? 'selected' : '' }}>WALK-IN
                </option>
            </select>
        </div>
    </div>
    {{-- Source --}}

    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Source</label>
            <select name="source" class="form-select uppercase-text" id="auto_source_name">
                <option value="">Select Type</option>
                @foreach ($sources as $source)
                    <option value="{{ $source->name }}" {{ $candidate->source == $source->name ? 'selected' : '' }}>
                        {{ $source->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-lg-3" id="auto_refer_name" style="display:none;">
        <div class="form-group">
            <label for="">Referrer Name: </label>
            <input type="text" class="form-control uppercase-text" name="refer_name"
                   value="{{ $candidate->refer_name ?? '' }}" placeholder="">
            @if ($errors->has('refer_name'))
                <span class="text-danger">{{ $errors->first('refer_name') }}</span>
            @endif
        </div>
    </div>
    
    <div class="col-lg-3" id="auto_refer_phone" style="display:none;">
        <div class="form-group">
            <label for="">Referrer Phone: </label>
            <input type="text" class="form-control uppercase-text" name="refer_phone"
                   value="{{ $candidate->refer_phone ?? '' }}" placeholder="">
            @if ($errors->has('refer_phone'))
                <span class="text-danger">{{ $errors->first('refer_phone') }}</span>
            @endif
        </div>
    </div>

   

    @if($candidate->source == 'REFERENCE')
    
    <div class="col-lg-3" id="refer_name">
        <div class="form-group">
            <label for="">Referrer Name: </label>
            <input type="text" class="form-control  uppercase-text" id="" name="refer_name"
                value="{{ $candidate->refer_name ?? '' }}" placeholder="">
            @if ($errors->has('refer_name'))
                <span class="text-danger">{{ $errors->first('refer_name') }}</span>
            @endif
        </div>
    </div>

    <div class="col-lg-3" id="refer_phone" >
        <div class="form-group">
            <label for="">Referrer Phone: </label>
            <input type="text" class="form-control  uppercase-text" name="refer_phone"
                value="{{ $candidate->refer_phone ?? '' }}" placeholder="">
            @if ($errors->has('refer_phone'))
                <span class="text-danger">{{ $errors->first('refer_phone') }}</span>
            @endif
        </div>
    </div>
    @endif


    {{-- referred_by --}}

    <div class="col-lg-3">
        <div class="form-group referred_by_id" id="">
            <label for="">Referred by </label>
            {{-- <input type="text" class="form-control  uppercase-text" id=""
                value="{{ $candidate->referred_by ?? '' }}" name="referred_by" placeholder=""> --}}
            <select name="referred_by_id" class="form-select  uppercase-text" id="">
                <option value="">Select</option>
                @foreach ($referrers as $refer)
                    <option value="{{ $refer['id'] }}" {{ $refer['id'] == $candidate->referred_by_id ? 'selected' : ''}}>{{ $refer['full_name'] }}</option>
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Associate by</label>
            <select name="associate_id" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                @foreach ($associates as $item)
                    <option value="{{ $item['id'] }}"
                        {{ $candidate->referred_by_id == $item['id'] ? 'selected' : '' }}>{{ $item['full_name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Religion: </label>
            <select name="religion" class="form-select  uppercase-text" id="">
                <option value="">Select Religion</option>
                <option value="HINDU" {{ $candidate->religion == 'HINDU' ? 'selected' : '' }}>Hindu</option>
                <option value="ISLAM" {{ $candidate->religion == 'ISLAM' ? 'selected' : '' }}>Islam</option>
                <option value="CHRISTIAN" {{ $candidate->religion == 'CHRISTIAN' ? 'selected' : '' }}>Christian
                </option>
                <option value="SIKH" {{ $candidate->religion == 'SIKH' ? 'selected' : '' }}>Sikh</option>
                <option value="BUDDHIST" {{ $candidate->religion == 'BUDDHIST' ? 'selected' : '' }}>Buddhist</option>
                <option value="JAIN" {{ $candidate->religion == 'JAIN' ? 'selected' : '' }}>Jain</option>
                <option value="OTHER" {{ $candidate->religion == 'OTHER' ? 'selected' : '' }}>Other</option>

            </select>
        </div>
    </div>
    
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">English Speak</label>
            <select name="english_speak" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="BASIC" {{ strtoupper($candidate->english_speak) == 'BASIC' ? 'selected' : '' }}>BASIC</option>
                <option value="GOOD" {{ strtoupper($candidate->english_speak) == 'GOOD' ? 'selected' : '' }}>GOOD</option>
                <option value="POOR" {{ strtoupper($candidate->english_speak) == 'POOR' ? 'selected' : '' }}>POOR</option>
                <option value="NO" {{ strtoupper($candidate->english_speak) == 'NO' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Arabic Speak</label>
            <select name="arabic_speak" class="form-select  uppercase-text" id="">
                <option value="">Select Type</option>
                <option value="BASIC" {{ strtoupper($candidate->arabic_speak) == 'BASIC' ? 'selected' : '' }}>BASIC</option>
                <option value="GOOD" {{ strtoupper($candidate->arabic_speak) == 'GOOD' ? 'selected' : '' }}>GOOD</option>
                <option value="POOR" {{ strtoupper($candidate->arabic_speak) == 'POOR' ? 'selected' : '' }}>POOR</option>
                <option value="NO" {{ strtoupper($candidate->arabic_speak) == 'NO' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Gulf Return</label>
            <select name="return" class="form-select  uppercase-text" id="">
                <option value="">Select Gulf Return </option>
                <option value="1" {{ $candidate->return == '1' ? 'selected' : '' }}>YES</option>
                <option value="0" {{ $candidate->return == '0' ? 'selected' : '' }}>NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group">
            <label for="">ECR Type</label>
            <select name="ecr_type" class="form-select  uppercase-text" id="">
                <option value="">Select ECR</option>
                <option value="ECR" {{ $candidate->ecr_type == 'ECR' ? 'selected' : '' }}>ECR</option>
                <option value="ECNR" {{ $candidate->ecr_type == 'ECNR' ? 'selected' : '' }}>ECNR</option>
            </select>
        </div>
    </div>

    {{-- <div class="col-lg-4">
        <div class="form-group">
            <label for="">Last Update Date</label>
            <input type="date" class="form-control  uppercase-text" id=""
                value="{{ $candidate->last_update_date ?? '' }}" name="last_update_date" placeholder="">
        </div>
    </div> --}}

    <div class="col-lg-3">
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

    @if($candidate->source == 'REFERENCE')
    @else 
    <div class="col-lg-3"></div>
    @endif
   

    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Remarks</label>
            <textarea class="form-control  uppercase-text" id="" rows="3" name="remark">{{ $candidate->lastCandidateActivity->remarks ?? '' }}</textarea>
        </div>
    </div>
@else
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Full Name <span>*</span></label>
        <input type="text" class="form-control  uppercase-text " id=""
            value="{{ old('full_name') }}" name="full_name" placeholder="">
        @if ($errors->has('full_name'))
            <span class="text-danger">{{ $errors->first('full_name') }}</span>
        @endif
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Email </label>
        <input type="text" class="form-control  uppercase-text" id="" value="{{ old('email') }}"
            name="email" placeholder="">
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>

<div class="col-lg-3">
    <div class="form-group date-btn">
        <label for="">DOB <span>*</span></label>
        <input type="text" class="form-control  uppercase-text datepicker" value="{{ old('dob') }}"
            name="dob" max="{{ date('Y-m-d') }}" placeholder="dd-mm-yy">
    </div>
    @if ($errors->has('dob'))
        <span class="text-danger">{{ $errors->first('dob') }}</span>
    @endif
</div>

<div class="col-lg-3">
    <div class="form-group">
        <label for="">Whatsapp NO: <span>*</span></label>
        <input type="text" class="form-control  uppercase-text" id="" name="whatapp_no"
            value="{{ old('whatapp_no') }}" placeholder="">
        @if ($errors->has('whatapp_no'))
            @error('whatapp_no')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        @endif
    </div>
</div>

<div class="col-lg-3">
    <div class="form-group">
        <label>Indian Driving License:<span>*</span></label>
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
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Gulf Driving License: <span>*</span></label>
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

<div class="col-lg-3">
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
<div class="col-lg-3">
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
<div class="col-lg-3">
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

<div class="col-lg-3">
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

<div class="col-lg-3">
    <div class="form-group">
        <label for="">Abroad Work Experience (If Any?)</label>
        <input type="text" class="form-control  uppercase-text" id=""
            value="{{ old('abroad_exp') }}" name="abroad_exp" placeholder="">

    </div>
</div>
<div class="col-lg-3">
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
<div class="col-lg-3">
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
<div class="col-lg-3">
    <div class="form-group">
        <label for="">State: </label>
        <select name="state_id" class="form-select select2 uppercase-text" id="state_id">
            <option value="">SELECT STATE</option>
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>
                    {{ $state->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label for="">City: </label>
        <select name="city_id" class="form-select select2 uppercase-text" id="city_id">
            <option value="">SELECT CITY</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="form-group">
        <label for="">Gender</label>
        <select name="gender" class="form-select  uppercase-text" id="">
            <option value="">Select Gender</option>
            <option value="MALE">MALE</option>
            <option value="FEMALE">FEMALE</option>
            <option value="OTHER">OTHER</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="form-group">
        <label for="">Education</label>
        <select name="education" class="form-select  uppercase-text" id="">
            <option value="">Select Type</option>
            <option value="5TH PASS" @if (old('education') == '5TH PASS') selected @endif>5TH PASS</option>
            <option value="8TH PASS" @if (old('education') == '8TH PASS') selected @endif>8TH PASS</option>
            <option value="10TH PASS" @if (old('education') == '10TH PASS') selected @endif>10TH PASS </option>
            <option value="HIGHER SECONDARY" @if (old('education') == 'HIGHER SECONDARY') selected @endif>Higher
                Secondary</option>
            <option value="GRADUATES" @if (old('education') == 'GRADUATES') selected @endif>GRADUATES</option>
            <option value="MASTERS" @if (old('education') == 'MASTERS') selected @endif>MASTERS</option>
        </select>
        {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ old('education') }}"
            name="education" placeholder=""> --}}
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Other Education</label>
        <input type="text" class="form-control  uppercase-text" id=""
            value="{{ old('other_education') }}" name="other_education" placeholder="">
    </div>
</div>

{{-- Mode of Registration --}}
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Mode of Registration</label>
        {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ old('mode_of_registration') }}"
            name="mode_of_registration" placeholder=""> --}}
        <select name="mode_of_registration" class="form-select  uppercase-text" id="">
            <option value="">Select Type</option>
            <option value="CALLING" @if (old('mode_of_registration') == 'CALLING') selected @endif>CALLING</option>
            <option value="WALK-IN" @if (old('mode_of_registration') == 'WALK-IN') selected @endif>WALK-IN</option>
        </select>
    </div>
</div>
{{-- Source --}}

<div class="col-lg-3" >
    <div class="form-group">
        <label for="">Source</label>
        <select name="source" class="form-select  uppercase-text" id="">
            <option value="">Select Type</option>
            @foreach ($sources as $source)
                <option value="{{ $source->name }}" @if (old('source') == $source->name) selected @endif>
                    {{ $source->name }}</option>
            @endforeach
        </select>
        {{-- <input type="text" class="form-control  uppercase-text" id="" value="{{ old('source') }}" name="source"
            placeholder=""> --}}
    </div>
</div>

<div class="col-lg-3" id="refer_name" style="display: none;">
    <div class="form-group">
        <label for="">Referrer Name: </label>
        <input type="text" class="form-control  uppercase-text"  name="refer_name"
            value="{{ $candidate->refer_name ?? '' }}" placeholder="">
        @if ($errors->has('refer_name'))
            <span class="text-danger">{{ $errors->first('refer_name') }}</span>
        @endif
    </div>
</div>

<div class="col-lg-3" id="refer_phone" style="display: none;">
    <div class="form-group">
        <label for="">Referrer Phone: </label>
        <input type="text" class="form-control  uppercase-text"  name="refer_phone"
            value="{{ $candidate->refer_phone ?? '' }}" placeholder="">
        @if ($errors->has('refer_phone'))
            <span class="text-danger">{{ $errors->first('refer_phone') }}</span>
        @endif
    </div>
</div>

{{-- referred_by --}}

<div class="col-lg-3">
    <div class="form-group referred_by_id" id="">
        <label for="">Referred by </label>
            <select name="referred_by_id" class="form-select  uppercase-text" id="">
                <option value="">Select</option>
                @foreach ($referrers as $refer)
                    <option value="{{ $refer['id'] }}">{{ $refer['full_name'] }}</option>
                    </option>
                @endforeach
            </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Associate</label>
        <select name="associate_id" class="form-select  uppercase-text" id="">
            <option value="">Select</option>
            @foreach ($associates as $item)
                <option value="{{ $item['id'] }}">{{ $item['full_name'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Religion: </label>
        <select name="religion" class="form-select  uppercase-text" id="">
            <option value="">Select Religion</option>
            <option value="HINDU" {{ old('religion') == 'HINDU' ? 'selected' : '' }}>Hindu</option>
            <option value="ISLAM" {{ old('religion') == 'ISLAM' ? 'selected' : '' }}>Islam</option>
            <option value="CHRISTIAN" {{ old('religion') == 'CHRISTIAN' ? 'selected' : '' }}>Christian</option>
            <option value="SIKH" {{ old('religion') == 'SIKH' ? 'selected' : '' }}>Sikh</option>
            <option value="BUDDHIST" {{ old('religion') == 'BUDDHIST' ? 'selected' : '' }}>Buddhist</option>
            <option value="JAIN" {{ old('religion') == 'JAIN' ? 'selected' : '' }}>Jain</option>
            <option value="OTHER" {{ old('religion') == 'OTHER' ? 'selected' : '' }}>Other</option>
        </select>
        {{-- <input type="text" class="form-control  uppercase-text" id="" name="religion"
            value="{{ old('religion') }}" placeholder=""> --}}
    </div>
</div>

<div class="col-lg-3">
    <div class="form-group">
        <label for="">English Speak</label>
        <select name="english_speak" class="form-select  uppercase-text" id="">
            <option value="">Select Type</option>
            <option value="BASIC" {{ old('english_speak') == 'BASIC' ? 'selected' : '' }}>BASIC</option>
            <option value="GOOD" {{ old('english_speak') == 'GOOD' ? 'selected' : '' }}>GOOD</option>
            <option value="POOR" {{ old('english_speak') == 'POOR' ? 'selected' : '' }}>POOR</option>
            <option value="NO" {{ old('english_speak') == 'NO' ? 'selected' : '' }}>NO</option>
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Arabic Speak</label>
        <select name="arabic_speak" class="form-select  uppercase-text" id="">
            <option value="">Select Type</option>
            <option value="BASIC" {{ old('arabic_speak') == 'BASIC' ? 'selected' : '' }}>BASIC</option>
            <option value="GOOD" {{ old('arabic_speak') == 'GOOD' ? 'selected' : '' }}>GOOD</option>
            <option value="POOR" {{ old('arabic_speak') == 'POOR' ? 'selected' : '' }}>POOR</option>
            <option value="NO" {{ old('arabic_speak') == 'NO' ? 'selected' : '' }}>NO</option>
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label for="">Gulf Return</label>
        <select name="return" class="form-select  uppercase-text" id="">
            <option value="">Select Gulf Return Type</option>
            <option value="1" {{ old('return') == '1' ? 'selected' : '' }}>YES</option>
            <option value="0" {{ old('return') == '0' ? 'selected' : '' }}>NO</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="form-group">
        <label for="">ECR Type</label>
        <select name="ecr_type" class="form-select  uppercase-text" id="">
            <option value="">Select ECR</option>
            <option value="ECR" {{ old('ecr_type') == 'ECR' ? 'selected' : '' }}>ECR</option>
            <option value="ECNR" {{ old('ecr_type') == 'ECNR' ? 'selected' : '' }}>ECNR</option>
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

<div class="col-lg-3">
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

<div class="col-lg-6">
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
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap5',
                    format: 'dd-mm-yyyy',
            maxDate: new Date(),

        });

    });
</script>

<script>
    $(document).ready(function() {
        function toggleReferFields() {
            var source_name = $('#auto_source_name').val();
            if (source_name === 'REFERENCE') {
                $('#auto_refer_name').show();
                $('#auto_refer_phone').show();
            } else {
                $('#auto_refer_name').hide();
                $('#auto_refer_phone').hide();
            }
        }

        // Run on page load
        toggleReferFields();

        // Run when the select value changes
        $('#auto_source_name').change(function() {
            toggleReferFields();
        });
    });
</script>
