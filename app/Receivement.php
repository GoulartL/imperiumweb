<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receivement extends Model
{
    protected $table = 'receipts';

    protected $fillable = [
        'id', 'company', 'description', 'client', 'emission', 'portion', 'due_date', 'value', 'receipt_date', 'receipt_value',
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
