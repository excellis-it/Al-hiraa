@if (count($feeds) > 0)
    @foreach ($feeds as $feed)
        <tr>
            <td class="edit-route" data-route="{{ route('members.edit', $feed['id']) }}">
                {{ $feed->title }}
            </td>

            <td >
                {{ $feed->created_at->format('d-m-Y') }}
            </td>
            
            
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="6" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $feeds->firstItem() }} – {{ $feeds->lastItem() }} feeds of
                    {{$feeds->total() }} feeds)
                </div>
                <div>{!! $feeds->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="6" class="text-center">No Data Found</td>
    </tr>
@endif
