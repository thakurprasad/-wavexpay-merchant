<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = 'merchants';
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_name', 'access_salt',  'contact_name', 'contact_phone', 'status', 'is_partner', 'reward_value', 'merchant_payment_method', 'referral_id', 'referred_by', 'created_at', 'updated_at'
    ];


    public function addresses()
    { 
         return $this->hasMany(MerchantAddress::class)->count();
    }  

    /*  include extra where condication in every select query    */
    public function newQuery($auth = true) {
        return parent::newQuery($auth)->where([
                'merchants.id' => session()->get('merchant')
            ]);
    }


}
