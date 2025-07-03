@php
    use App\Helpers\Helper;
@endphp

@if (count($companies) > 0)
    @foreach ($companies as $company)
        <tr>
            <td>{{ $company->company_name }}</td>
            @foreach (['FIT', 'UNFIT', 'BACKOUT', 'REPEAT','PENDING'] as $type)
                <td>
                    <a href="{{ route('jobs.index', ['medical_type' => $type, 'company_id' => $company->id]) }}">
                        {{ Helper::getMedicalReport($type, $company->id, $medical_month ?? null, $medical_year ?? null) }}
                    </a>
                </td>
            @endforeach
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No data found</td>
    </tr>
@endif
