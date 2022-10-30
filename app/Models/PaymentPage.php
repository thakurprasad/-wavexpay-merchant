<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentPage extends Model
{
    protected $table = 'payment_page';
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'template_id',  'page_title', 'page_url', 'unique_id', 'page_content', 'customer_name', 'customer_number', 'status', 'fb_link', 'twitter_link', 'whatsapp', 'support_email', 'support_phone', 'term_conditions', 'amount', 'payment_form_json', 'custom_url', 'theme', 'is_page_expiry', 'successful_custom_message', 'successful_redirect_url', 'facebook_pixel', 'google_analytics', 'created_at', 'updated_at'
    ];
}
