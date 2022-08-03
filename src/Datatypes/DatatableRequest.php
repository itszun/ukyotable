<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

use Illuminate\Http\Request;

class DatatableRequest {
    public function __construct(Request $data)
    {
        $this->draw = $data->draw;
        $this->start = $data->start;
        $this->length = $data->length;
        $this->search = new Search($data->search);
        $this->columns = new ColumnList($data->columns);
        $this->order = new OrderList($data->order);
        $this->order->forColumns($this->columns);
        UkyoCounter::getInstance()->setStart($this->start);
    }

    public function getColumnsData() {
        return $this->columns->getData();
    }
}
