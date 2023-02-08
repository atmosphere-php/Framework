<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation\Service;
use Symfony\Component\Yaml\Yaml;

class ServiceDefinitionResolver
{
    public function resolve(): array
    {
        return Yaml::parseFile(
            __DIR__ . '/../../../../Atmosphere/Processes/Services/Services.yaml'
        );
    }
}