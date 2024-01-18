<?php

namespace App\Http\Controllers\Filters\Catalog;

use Illuminate\Database\Eloquent\Builder;

trait SortByFilter
{
    public function scopeSortByFilter(Builder $query,  $sortBy): Builder
    {
        if($sortBy['sort'] === "+price"){
            return $query->orderBy('price', 'ASC');
        } else if($sortBy['sort'] === "-price"){
            return $query->orderBy('price', "DESC");
        } else if($sortBy['sort'] === "title"){
            return $query->orderBy('title', "ASC");
        } else {
            return $query;
        }
    }
}
