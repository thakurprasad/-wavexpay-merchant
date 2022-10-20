<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboardheader extends Model
{
    use HasFactory;
    protected $table = 'dashboardheader';
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $fillable = [
      'title', 'description', 'created_at', 'updated_at'
    ];
}
