<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;


class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'on_home_page',
        'sorting'
    ];
    /**
     * @var \Illuminate\Support\Stringable|mixed|__anonymous@6587
     */

    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Brand $brand){
            $brand->slug = $brand->slug ?? str($brand->title)->slug();
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
