@if (count($sources) > 0)
    @foreach ($sources as $source)
        <tr>
            <td>{{ ($sources->currentPage()-1) * $sources->perPage() + $loop->index + 1 }}</td>
            <td class="edit-route" data-route="{{ route('sources.edit', $source['id']) }}">
                {{$source->name }}</td>
            <td>
                <a title="Delete Source" data-route="{{ route('sources.delete', Crypt::encrypt($source->id)) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $sources->firstItem() }} – {{ $sources->lastItem() }} sources of
                    {{$sources->total() }} sources)
                </div>
                <div>{!! $sources->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


