<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineupStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'lineup_id',
        'status',
        'remarks',
        'updated_by'
    ];

    /**
     * Get the user who made this status change.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the lineup this log belongs to.
     */
    public function lineup()
    {
        return $this->belongsTo(Lineup::class);
    }
}
