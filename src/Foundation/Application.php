<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation;

use Atmospherephp\Framework\Http\HttpKernel;
use Atmospherephp\Framework\Console\ConsoleKernel;
use Atmospherephp\Framework\Foundation\Service\ServiceSet;
use Atmospherephp\Framework\Foundation\Container\Container;

class Application
{
    private readonly HttpKernel|ConsoleKernel $kernel;

    public readonly Container $container;

    /**
     * The constructor is in charge of bootstrapping
     * the (whole) application.
     *
     * @param  HttpKernel|ConsoleKernel  $kernel
     */
    public function __construct(HttpKernel|ConsoleKernel $kernel)
    {
        $this->container = new Container();

        // The kernel registers
        // processes into the
        // container.
        $this->kernel = $kernel;
        $kernel->bootstrap($this);

        // Determine, which services
        // are needed to fulfill
        // the request.
        $this->defineServices(
            $kernel->determineUsedServices()
        );
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