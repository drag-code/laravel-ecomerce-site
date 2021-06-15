<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const DRAFT = 1;
    const PUBLISHED = 2;
    protected $fillable = [
        'subcategory_id',
        'brand_id',
        'name',
        'description',
        'slug',
        'price',
        'quantity',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function colors() {
        return $this->belongsToMany(Color::class);
    }

    public function sizes() {
        return $this->hasMany(Size::class);
    }

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    public function image() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
