<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class audit extends Model
{
    use HasFactory;

    protected $table = "audit";

    protected $fillable = [
      'user_id',
      'usertype',
      'logindate',
      'logintime',
      'logouttime'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }
}
