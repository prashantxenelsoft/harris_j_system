<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'serving_client',
        'client_id',
        'primary_contact',
        'primary_mobile',
        'primary_email',
        'secondary_contact',
        'secondary_mobile',
        'secondary_email',
        'full_address',
        'description',
        'show_address_input',
        'client_status',
        'primary_mobile_country_code',
        'secondary_mobile_country_code',
        'user_id',
        'reset_password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
