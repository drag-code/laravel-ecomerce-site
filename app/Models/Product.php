<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const DRAFT = 1;
    const PUBLISHED = 2;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    // Accessors
    public function getStockAttribute() {
        if($this->subcategory->size) {
            return ColorSize::whereHas('size.product', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        } elseif ($this->subcategory->color) {
            return ColorProduct::whereHas('product', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        } else {
            return $this->quantity;
        }
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function colors() {
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
