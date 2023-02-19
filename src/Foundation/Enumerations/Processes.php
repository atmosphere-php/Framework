<?php

declare(strict_types=1);

namespace Atmospherephp\Framework\Foundation\Enumerations;

/**
 * Atmosphere Processes
 * --------------------
 *
 * @author Romano Schoonheim <romano@atmosphere.sh>
 */
enum Processes: string
{
    /**
     * Input / Output management.
     * --------------------------
     */
    case IO = 'IO';



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
