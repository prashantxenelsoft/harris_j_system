<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserManagment extends Model
{
    use HasFactory;

    protected $table = 'user_managment';

    protected $fillable = [
        'emp_name',
        'emp_code',
        'sex',
        'dob',
        'mobile_number',
        'mobile_number_code',
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
    ];

    public $timestamps = true;

    protected $casts = [
        'dob' => 'date',
        'joining_date' => 'date',
        'resignation_date' => 'date',
    ];
}
