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
        <h3>{{$interview->company->company_name ?? 'N/A'}} Interview</h3>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Interview Venue:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->company->company_address ?? 'N/A'}}</h4>
        </div>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Positions:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->jobTitle->candidatePosition->name ?? 'N/A'}}</h4>
        </div>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Interview Assigned:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->date_of_interview ?? 'N/A'}}</h4>
        </div>
    </div>
    <div class="food-status">
        <div class="food-status-1">
            <h4>Interview Venue:</h4>
        </div>
        <div class="food-status-2">
            <h4>{{$interview->interview_location ?? 'N/A'}}</h4>
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