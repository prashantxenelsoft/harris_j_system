<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultancy extends Model
{
    use HasFactory;

    protected $table = 'consultancy';

    protected $fillable = [
        'consultancy_name',
        'consultancy_id',
        'consultancy_logo',
        'uen_number',
        'full_address',
        'show_address_input',
        'primary_contact',
        'primary_mobile_country_code',
        'primary_mobile',
        'primary_email',
        'reset_password',
        'password',
        'secondary_contact',
        'secondary_email',
        'secondary_mobile_country_code',
        'secondary_mobile',
        'consultancy_status',
        'consultancy_type',
        'license_start_date',
        'license_end_date',
        'license_number',
        'last_paid_status',
        'last_paid_date',
        'payment_mode',
        'fees_structure',
        'admin_email',
    ];
}
