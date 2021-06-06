<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionDiary extends Model
{
    protected $table = 'production_diary';

    protected $fillable = [
        'id', 'company', 'date', 'employees', 'order', 'qty', 'observation'
    ];

    public static $fieldsRules = [
        'date' => 'required',
        'employees' => 'required',
        'order' => 'required',
        'qty' => 'required',
    ];
}
