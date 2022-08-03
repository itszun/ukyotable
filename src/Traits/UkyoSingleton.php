<?php
namespace ZunFuyuzora\UkyoTable\Traits;

trait UkyoSingleton
{
    protected static $instance;
    final public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }
    private function __construct() {
        $this->init();
    }
    protected function init() {}
    final public function __wakeup() {}
    private function __clone() {}
}
