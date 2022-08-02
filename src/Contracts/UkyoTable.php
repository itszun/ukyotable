<?php

namespace ZunFuyuzora\UkyoTable\Contracts;

interface UkyoTable {
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

}
