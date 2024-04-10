<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

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


    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
