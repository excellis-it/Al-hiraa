@if (count($referral_points) > 0)
    @foreach ($referral_points as $referral_point)
        <tr>
            <td>{{ ($referral_points->currentPage()-1) * $referral_points->perPage() + $loop->index + 1 }}</td>
            <td class="edit-route" data-route="{{ route('referral-points.edit', $referral_point['id']) }}">
                {{$referral_point->point }}</td>
            <td class="edit-route" data-route="{{ route('referral-points.edit', $referral_point['id']) }}">{{ $referral_point->amount }}</td>
            <td>
                <a title="Delete Feed" data-route="{{ route('referral-points.delete', $referral_point['id']) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $referral_points->firstItem() }} – {{ $referral_points->lastItem() }} referral points of
                    {{$referral_points->total() }} referral points)
                </div>
                <div>{!! $referral_points->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


