@if (count($cities) > 0)
    @foreach ($cities as $city)
        <tr>
            <td>{{ ($cities->currentPage()-1) * $cities->perPage() + $loop->index + 1 }}</td>
            <td>
                {{ $city->state->name ?? 'N/A' }}
            </td>
            <td class="edit-route" data-route="{{ route('cities.edit', $city['id']) }}">
                {{$city->name }}</td>
            <td>
                <a title="Delete Source" data-route="{{ route('cities.delete', Crypt::encrypt($city->id)) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $cities->firstItem() }} – {{ $cities->lastItem() }} cities of
                    {{$cities->total() }} cities)
                </div>
                <div>{!! $cities->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


