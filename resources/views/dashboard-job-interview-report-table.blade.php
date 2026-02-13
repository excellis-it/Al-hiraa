@php
    use App\Helpers\Helper;
@endphp
@if (count($companies) > 0)
    @foreach ($companies as $company)
        <tr>
            <td>{{ $company->company_name }}</td>
            <!-- Adjust if company name is under a different field -->
            {{-- <td>{{ Helper::getInterviewReport('Interested', $company->id, $new_month, $new_year) }} </td> --}}
            <td>{{ Helper::getInterviewReport('Selected', $company->id, $new_month, $new_year) }} </td>
            <td>{{ Helper::getInterviewReport('Medical', $company->id, $new_month, $new_year) }} </td>
            <td>{{ Helper::getInterviewReport('Documentaion', $company->id, $new_month, $new_year) }} </td>
            <td>{{ Helper::getInterviewReport('Deployment', $company->id, $new_month, $new_year) }} </td>
            <td>{{ Helper::getInterviewReport('Total Service Charge', $company->id, $new_month, $new_year) > 0 ? '₹' .Helper::getInterviewReport('Total Service Charge', $company->id, $new_month, $new_year) : '-' }} </td>
            <td>{{ Helper::getInterviewReport('Total Collection', $company->id, $new_month, $new_year) > 0 ? '₹' .Helper::getInterviewReport('Total Collection', $company->id, $new_month, $new_year) : '-' }} </td>
            <td>{{ Helper::getInterviewReport('Vendor Service Charge', $company->id, $new_month, $new_year) > 0 ? '₹' .Helper::getInterviewReport('Vendor Service Charge', $company->id, $new_month, $new_year) : '-' }} </td>
            <td>{{ Helper::getInterviewReport('Pending Collection', $company->id, $new_month, $new_year) > 0 ? '₹' .Helper::getInterviewReport('Pending Collection', $company->id, $new_month, $new_year) : '-' }} </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="9" class="text-center">No data found</td>
    </tr>
@endif
