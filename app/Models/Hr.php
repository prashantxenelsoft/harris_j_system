<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hr extends Model
{
    use HasFactory;

    protected $table = 'hr';

    protected $guarded = []; // All fields are mass assignable

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}