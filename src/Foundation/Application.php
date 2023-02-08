<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation;

use Atmospherephp\Framework\Foundation\Service\ServiceSet;
use Atmospherephp\Framework\Foundation\Container\Container;

class Application
{
    public readonly Container $container;

    public function __construct()
    {
        $this->container = new Container();
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
            $this->container->set($service->name, $service->value);
        }

        return $this;
    }


}