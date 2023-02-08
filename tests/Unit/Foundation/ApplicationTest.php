<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Tests\Unit\Foundation;

use PHPUnit\Framework\TestCase;
use Atmospherephp\Framework\Foundation\Application;

class ApplicationTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated(): void
    {
        $this->assertInstanceOf(Application::class, new Application());
    }

}