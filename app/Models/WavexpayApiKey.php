<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class WavexpayApiKey extends Model
{
    use HasFactory; use SoftDeletes;

  
    protected $casts = [
        'test_api_key', 
        'test_api_secret', 
        'live_api_key', 
        'live_api_secret'
    ];

    

}
