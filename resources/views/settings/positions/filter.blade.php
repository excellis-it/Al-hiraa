@if (count($positions) > 0)
    @foreach ($positions as $position)
        <tr id="positionBody-{{$position->id}}">
            @include('settings.positions.position-action')

        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $positions->firstItem() }} – {{ $positions->lastItem() }} positions of
                    {{$positions->total() }} positions)
                </div>
                <div>{!! $positions->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


