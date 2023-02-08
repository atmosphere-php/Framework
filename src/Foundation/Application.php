<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation;

use Atmospherephp\Framework\Http\HttpKernel;
use Atmospherephp\Framework\Console\ConsoleKernel;
use Atmospherephp\Framework\Foundation\Container\Container;
use Atmospherephp\Framework\Foundation\Enumerations\Processes;

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
        $this->container->defineServices(
            $kernel->determineUsedServices()
        );
    }

    /**
     * Handles the request by interpreting
     * the request and dispatching its intended
     * procedure.
     *
     * @return void
     */
    public function run(): void
    {
        //todo: implement this method.
    }
}