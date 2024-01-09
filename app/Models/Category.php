<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'title',
        'on_home_page',
        'sorting'
    ];

    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Category $category){
            $category->slug = $category->slug ?? str($category->title)->slug();
        });
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
