<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'id', 'company', 'type', 'taxvat', 'state_register_id', 'name', 'fantasy_name', 'address', 'number',
        'district', 'city', 'state', 'complement', 'zip_code', 'contact_name', 'phone_number_1', 'phone_number_2',
        'email_1', 'email_2', 'bank', 'agency', 'account', 'account_name', 'observation'
    ];

    public static $fieldsRules = [
        'name' => 'required',
        'email1' => ['nullable', 'email'],
        'email2' => ['nullable', 'email'],
    ];
}
