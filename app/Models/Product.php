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
<<<<<<< HEAD
        'user_id',
        'category_id', 
        'email', 
        'phone', 
=======
        'user_id'
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
{
    return $this->hasMany(ProductImage::class);
}
public function savedByUsers()
{
    return $this->belongsToMany(User::class, 'saved_products')->withTimestamps();
}
public function getSavedCountAttribute()
{
    return $this->savedByUsers()->count();
}
}
=======
}
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
