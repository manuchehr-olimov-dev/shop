<?php

namespace App\Http\Controllers\Filters\Catalog;

use Illuminate\Database\Eloquent\Builder;

trait PriceFilter
{
    public function scopeFilterPrice(Builder $query, $filters): void
    {

        if($filters['filters'] !== null) {

            // Ищем есть ли в массиве указанный фильтры - цены
            $price = array_key_exists('price', $filters['filters']) ? $filters['filters']['price'] : false;

            $query->when($filters['filters']['price'], function (Builder $q) use ($price) {
                    $q->whereBetween('price', [
                        $price['from'],
                        $price['to']
                    ]);
                });
        };
    }
}
