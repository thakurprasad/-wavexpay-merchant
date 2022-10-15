<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLink extends Model
{
    protected $table = 'payment_link';
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'reference_id',  'amount', 'currency', 'accept_partial', 'description', 'customer_email', 'customer_contact', 'notify_email', 'payment_link_id', 'short_url', 'link_text', 'notify_sms', 'reminder_enable', 'callback_url', 'callback_method', 'created_at', 'updated_at', 'deleted_at'
    ];
}
