@if (count($states) > 0)
    @foreach ($states as $state)
        <tr>
            <td>{{ ($states->currentPage()-1) * $states->perPage() + $loop->index + 1 }}</td>
       
            <td class="edit-route" data-route="{{ route('states.edit', $state['id']) }}">
                {{$state->name }}</td>
            <td>
                <a title="Delete Source" data-route="{{ route('states.delete', Crypt::encrypt($state->id)) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $states->firstItem() }} – {{ $states->lastItem() }} states of
                    {{$states->total() }} states)
                </div>
                <div>{!! $states->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


