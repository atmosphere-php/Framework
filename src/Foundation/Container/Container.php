<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation\Container;
class Container
{
    private array $services = [];

    public function set($name, $value)
    {
        $this->services[$name] = $value;
    }

    public function get($name)
    {
        return $this->services[$name];
    }
}