<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Tests\Unit\Foundation;

use PHPUnit\Framework\TestCase;
use Atmospherephp\Framework\Foundation\Application;
use Atmospherephp\Framework\Foundation\Service\Service;
use Atmospherephp\Framework\Foundation\Service\ServiceSet;
use Atmospherephp\Framework\Foundation\Container\Container;

class ApplicationTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated(): void
    {
        $application = new Application();

        $this->assertInstanceOf(Application::class, $application);
        $this->assertInstanceOf(Container::class, $application->container);
    }

    /** @test */
    public function define_services_defines_the_given_services_in_the_container(): void
    {
        $application = new Application();
        $returnValue = $application->defineServices(
            ServiceSet::make([
                new Service(
                    'service1',
                    'value1'
                ),
            ])
        );

        $this->assertInstanceOf(Application::class, $returnValue);
        $this->assertEquals('value1', $application->container->get('service1'));
    }

}