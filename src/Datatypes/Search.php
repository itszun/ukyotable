<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

class Search extends BaseData {
    protected $value;
    protected $regex;

    public function __construct($data)
    {
        if (gettype($data) != "array") {
            return;
        }
        $this->init($data);
    }

    public function init($data) {
        $this->value = $data['value'];
        $this->regex = $data['regex'];
    }
}
