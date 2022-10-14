<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'payment_id',  'amount', 'email', 'contact', 'payment_created_at', 'status', 'payment_method', 'created_at', 'updated_at'
    ];
}
