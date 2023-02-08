<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Http;
use Atmospherephp\Framework\Foundation\Application;
use Atmospherephp\Framework\Foundation\Service\ServiceSet;

class HttpKernel
{
    /**
     * Binds default procedures to the application.
     *
     * @param  Application  $app
     *
     * @return void
     */
    public function bootstrap(Application $app): void
    {
    }

    /**
     * Determine, which services are needed to fulfill the request.
     *
     * @return ServiceSet
     */
    public function determineUsedServices(): ServiceSet
    {
        return ServiceSet::make([]);
    }
}