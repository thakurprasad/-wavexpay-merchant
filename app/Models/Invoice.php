<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'reciept',  'short_url', 'type', 'description', 'date', 'customer_id', 'customer_name', 'customer_email', 'customer_contact', 'item_id', 'item_qty', 'customer_billing_address1', 'customer_billing_address2',  'customer_billing_zip', 'customer_billing_city', 'customer_billing_state', 'customer_billing_country', 'customer_shipping_address1', 'customer_shipping_address2', 'customer_shipping_zip', 'customer_shipping_city', 'customer_shipping_state', 'customer_shipping_country', 'merchant_id' , 'status', 'issue_date', 'expiry_date', 'place_of_supply', 'terms_condition', 'customer_notes', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }


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
