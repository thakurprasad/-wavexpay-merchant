<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = [
        'item_id',
        'invoice_id',
        'item_name',
        'description',
        'rate',
        'qty',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];


    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
