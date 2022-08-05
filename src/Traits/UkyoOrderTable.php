<?php

namespace ZunFuyuzora\UkyoTable\Traits;

use Illuminate\Database\Eloquent\Builder;
use ZunFuyuzora\UkyoTable\Datatypes\Order;
use ZunFuyuzora\UkyoTable\Datatypes\OrderList;

trait UkyoOrderTable {

    public function scopeUkyoOrder(Builder $query, $order): Builder {
        if ($order instanceof OrderList) {
            $parent = $order;
            $order = $order->list[0];
        } elseif ($order instanceof Order) {
            $parent = $order->getParent();
        }
        $column = $order->column;
        $dir = $order->dir;
        $column_name = $parent->getColumns($column)['data'];
        return $query->orderBy($column_name, $dir);
    }
}
