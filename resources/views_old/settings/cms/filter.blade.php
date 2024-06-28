@if (count($cms) > 0)
    @foreach ($cms as $page)
        <tr>
            <td class="edit-route" data-route="{{ route('cms.edit', $page->id) }}">{{ $page->page_name }}</td>
            <td class="edit-route" data-route="{{ route('cms.edit', $page->id) }}">
                {{ $page->title }}</td>
            <td class="edit-route" data-route="{{ route('cms.edit', $page->id) }}">
                {{ $page->slug }}</td>
            <td>
                @if ($page->is_active == '1')
                    Active
                @else
                    Inactive
                @endif
            </td>
            <td>
                <a title="Delete Position" data-route="{{route('cms.delete', $page->id)}}" href="javascript:void(0);" id="delete"> <span class="trash-icon"><i class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="5" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    (Showing {{ $cms->firstItem() }} – {{ $cms->lastItem() }}  pages of
                    {{ $cms->total() }}  pages)
                </div>
                <div>{!! $cms->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="5" class="text-center">No Data Found</td>
    </tr>
@endif
