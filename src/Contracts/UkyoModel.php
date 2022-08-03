<?php

namespace ZunFuyuzora\UkyoTable\Contracts;

use Illuminate\Database\Eloquent\Model;
use ZunFuyuzora\UkyoTable\Datatypes\UkyoCounter;
use ZunFuyuzora\UkyoTable\Traits\UkyoOrderTable;
use ZunFuyuzora\UkyoTable\Traits\UkyoPickTable;
use ZunFuyuzora\UkyoTable\Traits\UkyoSearchTable;

class UkyoModel extends Model {
    use UkyoPickTable, UkyoOrderTable, UkyoSearchTable;
    /**
     * List of field to search by keyword input
     *
     * @var array
     */
    protected $searchable = [];

    /**
     * Field that can be a condition
     *
     *
     * @var array
     */
    protected $options = [];

    public function getUkyoCounterAttribute() {
        return UkyoCounter::getInstance()->getIncrement();
    }
}
