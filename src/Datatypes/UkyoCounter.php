<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

use ZunFuyuzora\UkyoTable\Traits\UkyoSingleton;

class UkyoCounter {
    use UkyoSingleton;

    protected $start = 0;

    public function setStart($n) {
        $this->start = $n;
    }

    public function getIncrement() {
        $this->start = $this->start + 1;
        return $this->start;
    }
}
