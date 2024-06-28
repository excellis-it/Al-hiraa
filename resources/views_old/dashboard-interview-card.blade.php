@if(count($interview_list) > 0)

@foreach($interview_list as $interview)

<div class="food-box border_radius_0">
    <div class="food-box-img">
        @if($interview)
            <img src="{{ Storage::url($interview->company->company_logo)}}" alt="">
        @else
            <img src="{{ asset('assets/images/food-img-1.jpg') }}" alt="">
        @endif
    </div>
    <div class="food-box-head">
        <h3>{{$interview->company->company_name}} Interview</h3>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Interview Venue:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->company->company_address}}</h4>
        </div>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Positions:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->jobTitle->candidatePosition->name}}</h4>
        </div>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Interview Assigned:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->date_of_interview}}</h4>
        </div>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Interview Venue:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->interview_location}}</h4>
        </div>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Assign By:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->assignBy->first_name}} {{$interview->assignBy->last_name}}</h4>
        </div>
    </div>
    
</div>

@endforeach

@else



@endif