<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $table = 'settlements';
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'settlement_id', 'merchant_id', 'entity',  'amount', 'status', 'fees', 'tax', 'utr', 'created_at', 'updated_at'
    ];
}
