@if (count($candidates) > 0)
    @foreach ($candidates as $candidate)
        <tr @if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) class="candidate-new-{{ $candidate['id'] }}" @else
        class="{{ $candidate->is_call_id != null ? 'disabled-row' : '' }} candidate-new-{{ $candidate['id'] }}" id="candidate-{{ $candidate['id'] }}" @endif
            data-id="{{ $candidate['id'] }}">

            @include('candidates.update-single-data', ['candidate' => $candidate])
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="30" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $candidates->links() !!}
                </div>
                <div>(Showing {{ $candidates->firstItem() }} – {{ $candidates->lastItem() }} candidates of
                    {{ $candidates->total() }} candidates)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="30" class="text-center">No Data Found</td>
    </tr>
@endif
