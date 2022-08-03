<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

class ColumnList extends ListData
{
    protected $childClass = Column::class;

    public function getData() {
        $attributes = [];
        foreach($this->list as $v) {
            $attributes[] = $v->data;
        }
        return $attributes;
    }
}
