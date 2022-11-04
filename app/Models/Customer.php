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
        'customer_id', 'merchant_id',  'name', 'email', 'contact', 'gstin', 'created_at', 'updated_at'
    ];


    public function newQuery($auth = true) {
        return parent::newQuery($auth)        
            ->where('merchant_id',session()->get('merchant'));
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
