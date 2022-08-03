<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

class ItemData extends BaseData
{
    protected $parent;
    public function __construct(array | null $data, $parent = null)
    {
        $this->setParent($parent);
        $this->init($data);
    }

    public function init($data) {
        $this->data = $data;
    }

    public function setParent($parent) {
        $this->parent = $parent;
    }

    public function getParent() {
        return $this->parent;
    }

    public function toArray() {
        return $this->data;
    }
}
