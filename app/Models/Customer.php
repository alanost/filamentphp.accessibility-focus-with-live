<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'is_active',
        'gender',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
