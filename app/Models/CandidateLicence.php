<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLicence extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'licence_type',
        'licence_name'
    ];

    public function getAllFields()
    {
        return array_map('strtoupper', $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
