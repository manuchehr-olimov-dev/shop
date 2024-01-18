<?php

namespace App\Http\Controllers\Filters\Catalog;

use Illuminate\Database\Eloquent\Builder;

trait BrandFilter
{
    public function scopeFilterBrand(Builder $query, $filters): void
    {
        if($filters['filters'] !== null) {

            // Ищем есть ли в массиве указанный фильтр - бренд
            $brands = array_key_exists("brands", $filters['filters']) ? $filters['filters']['brands'] : false;

            $query->when($brands, function (Builder $q) use ($brands, $filters) {
                    $q->whereIn('brand_id', array_keys($brands));
                });

        };
    }
}
