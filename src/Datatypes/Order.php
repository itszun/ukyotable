<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

class Order extends ItemData
{
    protected int $column;
    protected string $dir;

    public function init($data)
    {
        if (gettype($data) == "array") {
            $this->column = $data['column'] ?? "";
            $this->dir = $data['dir'] ?? "";
        }
    }
}
