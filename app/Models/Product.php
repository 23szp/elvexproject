<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'condition',
        'image',
        'is_available',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
