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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
