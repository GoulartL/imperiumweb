<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'id', 'company', 'name', 'civil_state', 'position', 'sex', 'sector', 'vat', 'personal_id', 'phone_number_1',
        'phone_number_2', 'admission_date', 'removal_date', 'resignation_date', 'observation'
    ];

    public static $fieldsRules = [
        'name' => 'required',
        'position' => ['required'],
        'sector' => ['required']
    ];
}
