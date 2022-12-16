<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'theme_color', 'logo', 'language', 'merchant_id', 'created_at', 'updated_at'
    ];


/*  include extra where condication in every select query    */
   /* public function newQuery($auth = true) {
        if(session()->get('merchant')){
        return parent::newQuery($auth)->where([
                'merchant_id' => session()->get('merchant')
            ]);
        }else{
            // 
        }
    }*/

}
