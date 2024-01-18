<?php

namespace App\Models;

use App\Casts\Product\PriceCast;
use App\Http\Controllers\Filters\Catalog\BrandFilter;
use App\Http\Controllers\Filters\Catalog\PriceFilter;
use App\Http\Controllers\Filters\Catalog\SortByFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    use PriceFilter;
    use SortByFilter;
    use BrandFilter;
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
        $this->scopeFilterBrand  ($query, $filters);
        $this->scopeFilterPrice  ($query, $filters);
        $this->scopeSortByFilter ($query, $filters);
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
