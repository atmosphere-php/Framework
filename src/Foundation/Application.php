<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation;

use Atmospherephp\Framework\Http\HttpKernel;
use Atmospherephp\Framework\Http\IO\HttpInput;
use Atmospherephp\Framework\Console\ConsoleKernel;
use Atmospherephp\Framework\Console\IO\ConsoleInput;
use Atmospherephp\Framework\Foundation\Enumerations\Processes;
use Atmospherephp\Framework\Foundation\Service\ServiceDefinitionResolver;
use Atmospherephp\Framework\Foundation\Container\Container;
use Atmospherephp\Framework\Foundation\Enumerations\Feature;

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

        // Bind framework features to
        // the container that are
        // not kernel specific.
        $this->bindFrameworkFeaturesToContainer();

        // The kernel registers
        // processes into the
        // container.
        $this->kernel = $kernel;
        $kernel->bootstrap($this);

        // Resolve all the services
        // that can be used by the
        // current kernel.
        $services = $this->container->get(
            Feature::RESOLVE_SERVICES_DEFINITION->value
        )->resolve();

        $acceptedKind = ($kernel instanceof HttpKernel)
            ? 'http'
            : 'console';
        $services = array_filter($services, static fn (array $service): bool => $service['kind'] === $acceptedKind);

        // Determine, which services
        // are needed to fulfill
        // the request.
        /** @var ConsoleInput|HttpInput $input */
        $input = $this->container->get(Processes::INPUT->value);

        // Determine the intended
        // action based on the
        // input.
        $intend = $input->getIntendedAction();

        // We should now have
        // knowledge where to
        // dispatch the request
        // to.
        //
        // We should create some kind
        // of internal routing system
        $routes = [];
        foreach ($services as $service) {
            $directory = __DIR__ . '/../../../Atmosphere/Services/' . $service['directory'];
            $routing = require $directory . '/Routing.php';
            $routes[$service['name']] = $routing;
        }

        // Search for the intended
        // in the routes.
        $serviceToLoad = null;
        foreach ($routes as $service => $serviceRoutes) {
            foreach ($serviceRoutes as $route => $action) {
                if ($route === $intend) {
                    $serviceToLoad = $service;
                    break;
                }
            }
        }

        // Load the dependencies
        // into the container.
        //

        // $serviceToLoad


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
        var_dump($this->container);
    }

    private function bindFrameworkFeaturesToContainer(): void
    {
        $this->container->set(
            Feature::RESOLVE_SERVICES_DEFINITION->value,
            new ServiceDefinitionResolver()
        );
    }

}