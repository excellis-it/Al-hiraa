<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'company_website',
        'company_industry',
        'company_logo',
        'company_description',
        'status',

    ];

    public function getAllFields()
    {
        $fields = $this->fillable;
        $fields = array_map(function ($field) {
            return $field === 'company_logo' ? $field : strtoupper($field);
        }, $fields);

        return $fields;
    }

    public function setAttribute($key, $value)
    {
        if ($key !== 'company_logo' && !is_null($value)) {
            $value = strtoupper($value);
        }
        return parent::setAttribute($key, $value); // Ensure you return the parent call
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id')->where('status', 'Ongoing');
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'company_id');
    }
}
