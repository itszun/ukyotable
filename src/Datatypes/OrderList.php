<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

class OrderList extends ListData {
    protected $childClass = Order::class;
    protected $columns;

    public function forColumns(ColumnList $columns) {
        $this->columns = $columns;
        return $this;
    }

    public function getColumns(int | null $n = null) {
        if ($n == null) {
            return $this->columns->list;
        }
        return $this->columns->list[$n];
    }
}
