@if (count($contactUs) > 0)
    @foreach ($contactUs as $contact)
        <tr>
            <td>
                {{ $contact->full_name ?? 'N/A' }}
            </td>
            <td>
                {{ $contact->email ?? 'N/A' }}
            </td>
            <td>
                {{ $contact->phone ?? 'N/A' }}
            </td>
            <td>
                {{ $contact->message ?? 'N/A' }}
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    (Showing {{ $contactUs->firstItem() }} – {{ $contactUs->lastItem() }} contact us details of
                    {{ $contactUs->total() }} contact us details)
                </div>
                <div>{!! $contactUs->links() !!}</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="4" class="text-center">No Data Found</td>
    </tr>
@endif
