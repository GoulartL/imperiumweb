<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    protected $table = 'species';

    protected $fillable = [
        'id', 'name'
    ];

    public static $fieldsRules = [
        'name' => 'required'
    ];
}
