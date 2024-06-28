

@php
use App\Helpers\Helper;
@endphp

@if(count($most_candidates) > 0)   
@foreach($most_candidates as $data)
<tr>
    <td>
        <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                <g id="Group_86" data-name="Group 86" transform="translate(-1306 -464)">
                  <g id="Ellipse_124" data-name="Ellipse 124" transform="translate(1306 464)" fill="#fff" stroke="#d9d9d9" stroke-width="1">
                    <ellipse cx="12.5" cy="12" rx="12.5" ry="12" stroke="none"/>
                    <ellipse cx="12.5" cy="12" rx="12" ry="11.5" fill="none"/>
                  </g>
                  <g id="user" transform="translate(1314.853 470.551)">
                    <ellipse id="Ellipse_12" data-name="Ellipse 12" cx="2.588" cy="2.588" rx="2.588" ry="2.588" transform="translate(1.122 0)" fill="#6a6a6a"/>
                    <path id="Path_28" data-name="Path 28" d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z" transform="translate(-64 -292.628)" fill="#6a6a6a"/>
                  </g>
                </g>
            </svg>
            <span class="">{{$data->enter_by_name}} 
            {{-- role name --}}
            <small> , {{Helper::userRole($data->user_id)}}</small>
                </span>
        </div>
    </td>
    <td>{{$data->total}}</td>
    <td>{{Helper::interviewSchedule($data->user_id)}}</td>
    <td>{{Helper::interviewAppear($data->user_id)}}</td>
</tr>
@endforeach

<tr>
    <td colspan="4" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                (Showing {{ $most_candidates->firstItem() }} – {{ $most_candidates->lastItem() }} users of
                {{ $most_candidates->total() }} users)
            </div>
            <div>{!! $most_candidates->links() !!}</div>
        </div>
    </td>
</tr>
@else
<tr>
    <td colspan="4" class="text-center">No data found</td>
</tr>
@endif
