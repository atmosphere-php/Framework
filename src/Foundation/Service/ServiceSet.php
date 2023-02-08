<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation\Service;

use Iterator;
use InvalidArgumentException;

class ServiceSet implements Iterator
{
    /**
     * @var Service[]
     */
    public readonly array $services;

    private int $position = 0;

    public function __construct(array $services)
    {
        $this->services = $services;

        foreach ($this->services as $service) {
            if (! $service instanceof Service) {
                throw new InvalidArgumentException(
                    'Service must be an instance of ' . Service::class . '.'
                );
            }
        }
    }

    public static function make(array $services = []): ServiceSet
    {
        return new ServiceSet($services);
    }

    public function current(): Service
    {
        return $this->services[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->services[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
