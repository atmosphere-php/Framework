<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Http;

use Atmospherephp\Framework\Http\IO\HttpInput;
use Atmospherephp\Framework\Http\IO\HttpOutput;
use Atmospherephp\Framework\Foundation\Application;
use Atmospherephp\Framework\Foundation\Service\ServiceSet;
use Atmospherephp\Framework\Foundation\Enumerations\Processes;

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
        $app->container->set(Processes::INPUT->value, new HttpInput());
        $app->container->set(Processes::OUTPUT->value, new HttpOutput());
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
