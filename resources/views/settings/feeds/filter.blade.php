@if (count($feeds) > 0)
    @foreach ($feeds as $feed)
        <tr>
            <td>{{ ($feeds->currentPage()-1) * $feeds->perPage() + $loop->index + 1 }}</td>
            <td class="edit-route" data-route="{{ route('feeds.edit', $feed['id']) }}">
                {{$feed->title }}</td>
            <td class="edit-route" data-route="{{ route('feeds.edit', $feed['id']) }}">{{ $feed->content }}</td>
            <td>
                <a title="Delete Feed" data-route="{{ route('feeds.delete', Crypt::encrypt($feed->id)) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="4" class="text-left">
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
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


