@if (count($members) > 0)
    @foreach ($members as $member)
        <tr>
            <td class="edit-route" data-route="{{ route('members.edit', $member['id']) }}">
                <span class="user-icon">
                    @if ($member->profile_picture)
                        <img src="{{ Storage::url($member->profile_picture) }}" class="table-img" alt="">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                            <g id="Group_86" data-name="Group 86" transform="translate(-435.5 -219)">
                                <g id="Ellipse_85" data-name="Ellipse 85" transform="translate(435.5 219)"
                                    fill="#fff" stroke="#d9d9d9" stroke-width="1">
                                    <ellipse cx="12.5" cy="12" rx="12.5" ry="12"
                                        stroke="none" />
                                    <ellipse cx="12.5" cy="12" rx="12" ry="11.5"
                                        fill="none" />
                                </g>
                                <g id="user" transform="translate(444.352 226)">
                                    <ellipse id="Ellipse_12" data-name="Ellipse 12" cx="2.588" cy="2.588"
                                        rx="2.588" ry="2.588" transform="translate(1.122 0)" fill="#6a6a6a" />
                                    <path id="Path_28" data-name="Path 28"
                                        d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z"
                                        transform="translate(-64 -292.628)" fill="#6a6a6a" />
                                </g>
                            </g>
                        </svg>
                    @endif

                </span>
                {{ $member->full_name }}
            </td>
            <td @can('Edit Team') class="edit-route" data-route="{{ route('members.edit', $member['id']) }}" @endcan>
                {{ date('d/m/Y', strtotime($member->created_at)) }}</td>
            <td @can('Edit Team') class="edit-route" data-route="{{ route('members.edit', $member['id']) }}" @endcan>
                {{ $member->phone }}</td>
            <td @can('Edit Team') class="edit-route" data-route="{{ route('members.edit', $member['id']) }}" @endcan>
                {{ $member->email }}</td>

                <td @can('Edit Team') class="edit-route" data-route="{{ route('members.edit', $member['id']) }}" @endcan>
                    {{ $member->code ?? '-' }}</td>
                    <td @can('Edit Team') class="edit-route" data-route="{{ route('members.edit', $member['id']) }}" @endcan>
                        {{ $member->vendor_service_charge > 0 ? '₹'. $member->vendor_service_charge : '-' }}</td>
            <td @can('Edit Team') class="edit-route" data-route="{{ route('members.edit', $member['id']) }}" @endcan>
                {{ $member->getRoleNames()->first() }}
            </td>
            <td>
                <div class="button-switch">
                    <input type="checkbox" id="switch-orange" class="switch toggle-class"
                        data-id="{{ $member['id'] }}"
                        {{ $member['is_active'] ? 'checked' : '' }} />
                    <label for="switch-orange" class="lbl-off"></label>
                    <label for="switch-orange" class="lbl-on"></label>
                </div>
            </td>
            @can('Delete Team')
            <td>
                <a title="Delete User" data-route="{{ route('members.delete', Crypt::encrypt($member->id)) }}"
                    href="javascipt:void(0);" id="delete"> <span class="trash-icon"><i
                            class="fas fa-trash"></i></span></a>
            </td>
            @endcan
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="9" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                     (Showing {{ $members->firstItem() }} – {{ $members->lastItem() }} members of
                    {{$members->total() }} members)
                </div>
                <div>{!! $members->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="9" class="text-center">No Data Found</td>
    </tr>
@endif
