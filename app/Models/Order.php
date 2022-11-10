<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'order_id',  'amount', 'attempts', 'receipt', 'status', 'order_created_at', 'created_at', 'updated_at', 'transaction_mode'
    ];


/* Auto append transaction_mode column on Model::Create    */

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
            $model->merchant_id = session()->get('merchant'); # merchant id 
            $model->transaction_mode = session()->get('mode'); #test|live           
            $model->created_at = date('Y-m-d H:i:s'); 
           # $model->created_by = session()->get('merchant'); # merchant id 

       }); 

       static::updating(function($model)
       {
            $model->updated_at = date('Y-m-d H:i:s');  
           # $model->updated_at = session()->get('merchant'); #merchant id 
           
       }); 
   }

    
/*  include extra where condication in every select query    */
    public function newQuery($auth = true) {
        return parent::newQuery($auth)->where([
                'merchant_id' => session()->get('merchant'), 
                'transaction_mode'=> session()->get('mode') 
            ]);
    }

}