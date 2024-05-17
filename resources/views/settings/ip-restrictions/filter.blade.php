@if (count($ipRestrictions) > 0)
    @foreach ($ipRestrictions as $ipRestriction)
        <tr>
            <td>
                {{ $loop->iteration + $ipRestrictions->firstItem() - 1 }}
            </td>
            <td class="edit-route" data-route="{{ route('ip-restrictions.edit', $ipRestriction['id']) }}">
                {{$ipRestriction->ip_address }}</td>
            <td class="edit-route" data-route="{{ route('ip-restrictions.edit', $ipRestriction['id']) }}" >
                @if($ipRestriction->is_active == '1')
                    Active
                @else
                    Inactive
                @endif
            </td>
            <td>
                <a title="Delete ipRestriction" data-route="{{ route('ip-restrictions.delete', Crypt::encrypt($ipRestriction->id)) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $ipRestrictions->firstItem() }} – {{ $ipRestrictions->lastItem() }} ipRestrictions of
                    {{$ipRestrictions->total() }} ipRestrictions)
                </div>
                <div>{!! $ipRestrictions->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif


