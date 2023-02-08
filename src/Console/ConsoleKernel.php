<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Console;

use Atmospherephp\Framework\Foundation\Application;
use Atmospherephp\Framework\Console\IO\ConsoleInput;
use Atmospherephp\Framework\Console\IO\ConsoleOutput;
use Atmospherephp\Framework\Foundation\Service\ServiceSet;
use Atmospherephp\Framework\Foundation\Enumerations\Processes;

class ConsoleKernel
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
        $processes = [
            Processes::INPUT->value => new ConsoleInput(),
            Processes::OUTPUT->value => new ConsoleOutput(),
        ];

        foreach ($processes as $name => $process) {
            $app->container->set($name, $process);
        }
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
