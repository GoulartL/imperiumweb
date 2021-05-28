<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'receipts';

    protected $fillable = [
        'id','company','code','customer','entry_date','incoming_invoice','ref','model','collection','qty',
        'price','cancellation_date','cancellation_reason','delivery_date_sewing','expected_date_sewing',
        'departure_date_sewing','delivery_date_finishing','expected_date_finishing','departure_date_finishing',
        'entry_date_expedition','outgoing_invoice','departure_date_expedition','observation'
    ];

    public static $fieldsRules = [
        'id' => 'required',
        'company' => 'required',
        'code' => 'required',
        'customer' => 'required',
        'entry_date' => 'required',
        'incoming_invoice' => 'required',
        'qty' => 'required',
        'price' => 'required'
    ];
}
