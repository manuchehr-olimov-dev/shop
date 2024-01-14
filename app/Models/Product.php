<?php

namespace App\Models;

use App\Casts\Product\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'brand_id',
        'price',
        'thumbnail',
        'on_home_page',
        'sorting'
    ];

    protected $casts = [
        'price' => PriceCast::class
    ];

    public function scopeFiltered(Builder $query, $filters)
    {

            if($filters['filters'] !== null) {

                // Ищем есть ли в массиве указанные фильтры бренды/цены
                $brands = array_key_exists("brands", $filters['filters']) ? $filters['filters']['brands'] : false;
                $price = array_key_exists('price', $filters['filters']) ? $filters['filters']['price'] : false;


                $query
                    ->when($brands, function (Builder $q) use ($brands, $filters) {
                        $q->whereIn('brand_id', array_keys($brands));
                    })
                    ->when($filters['filters']['price'], function (Builder $q) use ($price) {
                        $q->whereBetween('price', [
                            $price['from'],
                            $price['to']
                        ]);
                });
            };
    }

    public function scopeSorted(Builder $query, $sortBy): Builder
    {
        if($sortBy === "+price"){
            return $query->orderBy('price', 'ASC');
        } else if($sortBy === "-price"){
            return $query->orderBy('price', "DESC");
        } else if($sortBy === "title"){
            return $query->orderBy('title', "ASC");
        } else {
            return $query;
        }


    }

    public function scopeHomePage(Builder $query): void
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }

    protected static function boot(): void
    {
        parent::boot();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
