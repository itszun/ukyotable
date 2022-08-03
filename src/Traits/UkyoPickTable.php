<?php

namespace ZunFuyuzora\UkyoTable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UkyoPickTable {
    protected $ukyo_default_limit = 10;
    /**
     * Let Ukyo able to pick your data model by offset and limit
     *
     * @param Builder $query
     * @param integer $offset
     * @param integer $limit
     * @return Builder
     */
    public function scopePick(Builder $query, $offset, $limit): Builder {
        $offset = !is_null($offset) ? (int) $offset : 0;
        $limit = !is_null($limit) ? (int) $limit : $this->ukyo_default_limit;
        return $query->offset($offset)->limit($limit);
    }

    public function scopePage(Builder $query, $pageNumber, $perPage): Builder {
        $limit = $perPage ?? $this->ukyo_default_limit;
        $offset = $limit * ($pageNumber - 1);
        return $query->offset($offset)->limit($limit);
    }
}
