<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

class Column extends ItemData
{
    protected string $name;
    protected string $data;
    protected bool | null $searchable;
    protected bool | null $orderable;
    protected Search | null $search;

    public function init($data) {
        if (gettype($data) == "array") {
            $this->name = $data['name'] ?? "";
            $this->data = $data['data'] ?? "";
            $this->searchable = $data['searchable'] ?? "";
            $this->orderable = $data['orderable'] ?? "";
            $this->search = array_key_exists('search', $data) ? new Search($data['search']) : null;
        }
    }
}
