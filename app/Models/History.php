<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
     use HasFactory;

    protected $table = "histories";

    protected $fillable = [
      'order_id',
      
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
