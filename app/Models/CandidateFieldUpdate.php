<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateFieldUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'candidate_id',
        'status',
        'is_granted',
    ];

    protected $table = 'candidate_field_updates';

    public function candidateStatus()
    {
        return $this->belongsTo(CandidateStatus::class, 'status', 'id');
    }
}
