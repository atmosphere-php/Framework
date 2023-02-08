<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation\Enumerations;

enum Processes: string
{
    /**
     * Process that manages
     * the input of the application.
     *
     */
    case INPUT = 'input';

    /**
     * Process that manages
     * the output of the application.
     *
     */
    case OUTPUT = 'output';


    /**
     * @return string
     */
    public function getValue(): string
    {
        return 'process_' . $this->value;
    }
}
