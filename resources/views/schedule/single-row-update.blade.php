 <td class="py-3">{{ $interview['company']['company_name'] }}</td>
 <td class="py-3">{{ $interview['job']['job_id'] ?? '-' }}</td>
 <td class="py-3">{{ $interview['job']['job_name'] ?? '-' }}</td>
 <td class="py-3">
     <div class="d-flex align-items-center">
         <span class="name_textbg">
             {{ isset($interview['user']['first_name']) ? substr($interview['user']['first_name'], 0, 1) : '' }}{{ isset($interview['user']['last_name']) ? substr($interview['user']['last_name'], 0, 1) : '' }}
         </span>
         <span class="text-dark">{{ $interview['user']['first_name'] ?? '' }}
             {{ $interview['user']['last_name'] ?? '' }}</span>
     </div>
 </td>
 <td class="py-3">
     <span class="text-dark">
         {{ isset($interview['interview_start_date']) ? date('d/m/Y', strtotime($interview['interview_start_date'])) : '' }}
         @if (isset($interview['interview_start_date']) &&
                 isset($interview['interview_end_date']) &&
                 $interview['interview_start_date'] != $interview['interview_end_date']
         )
             <span class="text-muted mx-1">-</span>
             {{ date('d/m/Y', strtotime($interview['interview_end_date'])) }}
         @endif
     </span>
 </td>
 <td class="py-3">{{ $interview['interview_location'] ?? '-' }}</td>
 <td class="py-3 text-center">
     <a href="javascript:void(0);" class="edit-route text-primary"
         data-route="{{ route('schedule-to-do.edit', Crypt::encrypt($interview['id'])) }}" title="Edit Interview">
         <i class="fas fa-edit"></i>
     </a>
 </td>
