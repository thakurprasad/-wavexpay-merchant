<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
#use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    #use SoftDeletes;
    protected $table = 'customers';
    protected $primaryKey = 'id'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'merchant_id',  'name', 'email', 'contact', 'gstin', 'created_at', 'updated_at', 'transaction_mode'
    ];


/* Auto append transaction_mode column on Model::Create    */
  
    
    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {

           if($model->merchant_id){ 
                $model->merchant_id = session()->get('merchant'); # merchant id 
           }

           if($model->transaction_mode){
                $model->transaction_mode = session()->get('mode'); # test|live
           }

           if($model->created_at){
                $model->created_at = date('Y-m-d H:i:s'); 
           }

            if($model->created_by){
                $model->created_by = session()->get('merchant'); # merchant id 
            }
           
       }); 

       static::updating(function($model)
       {
            if($model->updated_at){
                $model->updated_at = date('Y-m-d H:i:s');    
            }
            
            if($model->updated_at){
                $model->updated_at = session()->get('merchant'); #merchant id 
            }
       }); 
   }

    
/*  include extra where condication in every select query    */
    public function newQuery($auth = true) {
        return parent::newQuery($auth)->where([
                'merchant_id' => session()->get('merchant'), 
                'transaction_mode'=> session()->get('mode') 
            ]);
    }



    public function scopeMerchent($query)
    {
        $merchant_id =  session()->get('merchant');            
        return $query->where('merchant_id', $merchant_id);
    }

    # use like -  Customer::with(['addresses'])->get();      
    public function addresses()
    { 
         return $this->hasMany(CustomerAddress::class);
    }    


}
