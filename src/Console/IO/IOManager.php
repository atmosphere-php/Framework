<?php

declare(strict_types=1);


namespace Atmospherephp\Framework\Console\IO;


class IOManager
{
    public readonly array $rawInput;

    public readonly int $rawInputLength;

    /**
     * Path to the entrypoint file of the command.
     *
     * This is relative to the working directory of
     * the CLI.
     *
     * @var string
     */
    public readonly string $commandEntrypointPath;

    /**
     * The command that was executed.
     *
     * @var string|null
     */
    public readonly string|null $command;

    /**
     * The arguments that were passed to the command.
     *
     * @var array
     */
    public readonly array $arguments;

    /**
     * The options that were passed to the command.
     *
     * @var array
     */
    public readonly array $options;

    public function __construct()
    {
        // Set the raw input.
        //
        $this->rawInput = $_SERVER['argv'];
        $this->rawInputLength = $_SERVER['argc'];

        // Parse the raw input into
        // the command, arguments and
        // options.
        //
        $this->parseRawInput();
    }

    private function parseRawInput(): void
    {
        // The first argument is the
        // path to the entrypoint file
        // of the command.
        //
        // This path is relative to the
        // working directory of the CLI.
        //
        $this->commandEntrypointPath = $this->rawInput[0];

        // The second argument is the
        // command that was executed.
        //
        $this->command = $this->rawInput[1] ?? null;

        if ($this->rawInputLength > 2) {
            // The third argument and
            // further are the arguments
            // that were passed to the
            // command.
            //
            // Arguments do not start with
            // a dash.
            //
            $this->arguments = array_filter($this->rawInput, static fn (string $argument): bool => $argument[0] !== '-');

            // Extract the options from the raw input.
            // Each option has the following format: --<option-name>=<option-value>
            //
            $options = [];
            $rawOptions = array_filter($this->rawInput, static fn (string $argument): bool => $argument[0] === '-');
            foreach ($rawOptions as $rawOption) {
                $option = explode('=', $rawOption);
                $key = str_replace('--', '', $option[0]);
                $value = $option[1] ?? null;

                $options[$key] = $value;
            }
            $this->options = $options;
        }
    }

    /**
     * Interpret the input
     * and return the intended
     * action.
     *
     * @return null|string
     */
    public function getIntendedAction(): null|string
    {
        return $this->command;
    }
}