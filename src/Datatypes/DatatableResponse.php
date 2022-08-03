<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

use Illuminate\Http\Request;

class DatatableResponse {
    public function __construct(Request $data)
    {
        $this->draw = 2;
        $this->recordsFiltered;
        $this->recordsTotal;
    }
}
