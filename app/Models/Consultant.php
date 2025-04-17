<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    protected $table = 'consultants';

    protected $fillable = [
        'emp_name',
        'emp_code',
        'sex',
        'dob',
        'mobile_number',
        'email',
        'receipt_file',
        'full_address',
        'show_address_input',
        'joining_date',
        'resignation_date',
        'status',
        'designation',
        'login_email',
        'reset_password',
        'user_id',
        'client_id',
        'client_name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
