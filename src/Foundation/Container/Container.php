<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation\Container;
use Atmospherephp\Framework\Foundation\Service\ServiceSet;

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

    /**
     * Define application services into the container.
     *
     * @param ServiceSet $services
     * @return $this
     */
    public function defineServices(ServiceSet $services): self
    {
        foreach ($services as $service) {
            $this->set($service->name, $service->value);
        }

        return $this;
    }
}