<?php

declare(strict_types=1);


namespace Atmospherephp\Framework\Foundation\Service;


class Service
{
    public readonly string $name;
    public readonly mixed $value;

    public function __construct(string $name, mixed $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

}