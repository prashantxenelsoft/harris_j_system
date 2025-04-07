<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Specify the table name (optional if table name is 'departments')
    protected $table = 'departments';

    // Allow mass assignment on these fields
    protected $fillable = [
        'department_name',
    ];
}
