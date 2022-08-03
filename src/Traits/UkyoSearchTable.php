<?php

namespace ZunFuyuzora\UkyoTable\Traits;

use Illuminate\Database\Eloquent\Builder;
use ZunFuyuzora\UkyoTable\Datatypes\DatatableRequest;
use ZunFuyuzora\UkyoTable\Datatypes\Order;
use ZunFuyuzora\UkyoTable\Datatypes\OrderList;
use ZunFuyuzora\UkyoTable\Datatypes\Search;

trait UkyoSearchTable {

    public function scopeUkyoSearch(Builder $query, DatatableRequest $payload): Builder {
        $query = $query->where(function($q) use ($payload) {
            foreach($this->searchable as $column) {
                if ($column == "ukyoCounter") {
                    continue;
                }
                $q->orWhere($column, 'LIKE', "%".$payload->search['value']."%");
            }
        });
        return $query;
    }
}
