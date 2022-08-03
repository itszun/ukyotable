<?php

namespace ZunFuyuzora\UkyoTable\Datatypes;

class ListData extends BaseData
{
    public $list = [];
    protected $childClass = ItemData::class;
    public function __construct(array | null $data)
    {
        if (gettype($data) == "array") {
            foreach ($data as $k => $v) {
                if ($k == "") {
                    continue;
                }
                $this->list = array_merge($this->list, [$k => $this->createObject($v)]);
            }
        }
    }

    public function createObject($a) {
        return new $this->childClass($a, $this);
    }

    public function toArray()
    {
        return $this->list;
    }
}
