<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Tests\Unit\Foundation;

use PHPUnit\Framework\TestCase;
use Atmospherephp\Framework\Console\ConsoleKernel;
use Atmospherephp\Framework\Foundation\Application;
use Atmospherephp\Framework\Foundation\Service\Service;
use Atmospherephp\Framework\Foundation\Service\ServiceSet;
use Atmospherephp\Framework\Foundation\Container\Container;

class ApplicationTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated(): void
    {
        $application = new Application(
            new ConsoleKernel()
        );

        $this->assertInstanceOf(Application::class, $application);
        $this->assertInstanceOf(Container::class, $application->container);
    }
}
