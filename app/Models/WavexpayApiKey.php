<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class WavexpayApiKey extends Model
{
    use HasFactory; use SoftDeletes;

  
    protected $casts = [
        'api_key', 'api_secret'
    ];

}
