<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'company_website',
        'company_industry',
        'company_logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}