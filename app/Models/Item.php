<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'name',  'description', 'amount', 'currency', 'created_at', 
        'updated_at',
        'merchant_id',
        'transaction_mode',
        'wavexpay_api_key_id'
    ];


    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
            $model->merchant_id = session()->get('merchant'); # merchant id 
            $model->transaction_mode = session()->get('mode'); #test|live           
            $model->wavexpay_api_key_id =  \App\Models\Merchant::find(session('merchant'))->wavexpay_api_key_id;

       }); 
    }



/*  include extra where condication in every select query    */
    public function newQuery($auth = true) {
        return parent::newQuery($auth)->where([
                'merchant_id' => session()->get('merchant'), 
                'transaction_mode'=> session()->get('mode'),
                'wavexpay_api_key_id'=>  \App\Models\Merchant::find(session('merchant'))->wavexpay_api_key_id
            ]);
    }


}
