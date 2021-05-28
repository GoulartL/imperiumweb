<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'id', 'company', 'description', 'client', 'emission', 'portion', 'due_date', 'value', 'payment_date', 'payment_value',
        'species', 'observation'
    ];

    public static $fieldsRules = [
        'description' => 'required',
        'client' => 'required',
        'emission' => 'required',
        'portion' => 'required',
        'due_date' => 'required',
        'value' => 'required',
        'species' => 'required',
    ];


    public static $fieldsRulesNew = [
        'description' => 'required',
        'client' => 'required',
        'emission' => 'required',
        'species' => 'required'
    ];
}
