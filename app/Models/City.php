<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_id',
    ];

    public function getAllFields()
    {
        return array_map('strtoupper', $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        if ($value !== null) {
            $value = strtoupper($value);
        }
        parent::setAttribute($key, $value);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }


}
