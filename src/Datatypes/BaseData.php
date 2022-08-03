<?php
namespace ZunFuyuzora\UkyoTable\Datatypes;

use ArrayAccess;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\JsonEncodingException;
use JsonSerializable;

class BaseData implements Arrayable, ArrayAccess, Jsonable, JsonSerializable {

    public function offsetExists($offset): bool {
        return isset($this->{$offset});
    }
    public function offsetGet($offset) {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }
    public function offsetUnset($offset): void {
        unset($this->{$offset});
    }
    public function offsetSet($offset, $value): void {
        if (is_null($offset)) {
            $this->{$offset} = $value;
        } else {
            $this->{$offset} = $value;
        }
    }

    /**
     * Arrayable Interface Implementation
     *
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    public function __set($name, $value)
    {
        try {
            $this->{$name} = $value;
        } catch (\Throwable $th) {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property via __set(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }
    }

    public function __get($name)
    {
        try {
            return $this->{$name};
        } catch (\Throwable $th) {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }
    }

    /**
     * Jsonable Interface Implementation
     *
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * Jsonserializeable interface implementation
     *
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }


}
