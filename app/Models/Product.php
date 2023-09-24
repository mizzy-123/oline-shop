<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'category_id',
        'name',
        'password',
        'slug',
        'description',
        'harga',
        'qty'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function fotoProduct()
    {
        return $this->hasMany(FotoProduct::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['price'] ?? false, function ($query, $price) {
            preg_match_all('/\d+/', $price, $matches);
            $min = intval($matches[0][0]);
            $max = intval($matches[0][1]);
            return $query->where(function ($query) use ($min, $max) {
                $query->whereBetween('harga', [$min, $max]);
            });
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) { // whre has berfungsi untuk mencari relasinya siapa
                $query->where('id', $category);
            });
        });

        $query->when($filters['orderPrice'] ?? false, function ($query, $orderPrice) {
            return $query->orderBy('harga', $orderPrice);
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
