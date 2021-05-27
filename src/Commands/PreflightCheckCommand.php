<?php

namespace Lamalama\PreflightCheck\Commands;

use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;
use Lamalama\PreflightCheck\Checks\PreflightCheck;
use Lamalama\PreflightCheck\Exceptions\NoPreflightChecksDefinedException;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class PreflightCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preflight:check
                            {--only-show-failures : Hides output from passing checks only show errors (incompatible with verbose)}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks that the application is configured and aligned correctly to begin accepting requests.';

    /**
     * @psalm-var array<class-string>
     */
    protected array $preflightSteps = [];

    protected Pipeline $pipeline;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $checks = config("preflight");
        $this->info('Starting Preflight Checks');
        $output = new ConsoleOutput();
        $onlyFails = $this->option('only-show-failures');
        $failed = 0;
        foreach ($checks as $check) {
            $outputStyle = new OutputFormatterStyle('black', 'red', ['bold', 'blink']);

            if (!$onlyFails && env($check) === '') {
                ++$failed;
                $output->getFormatter()->setStyle('fire', $outputStyle);
                $output->writeln('<fire>[FAIL] Configuration: Missing Environment Values. For More Information use {--only-show-failures} flag.</>');
                break;
            } elseif ($onlyFails && env($check) === '') {
                {
                    ++$failed;
                    $output->getFormatter()->setStyle('fire', $outputStyle);
                    $output->writeln('<fire>' . $check . ' Has no value</>');
                }
            }
        }
        if ($failed === 0) {
            $outputStyle = new OutputFormatterStyle('black', 'green', ['bold', 'blink']);
            $output->getFormatter()->setStyle('fire', $outputStyle);
            $output->writeln('<fire>All Checks have passed, you can deploy!</>');
        }
//                ;
//        if ($onlyFails) {
//            foreach ($checks as $check)
//            {
//
//            }
//
//        }
//dd($onlyFails);
//        return $passed;
//
//        $onlyFails = $this->option('only-show-failures');
//        $passed = $results->reduce(function ($carry, $result) use ($onlyFails) {
//            $this->line(
//                sprintf(
//                    '[%s] %s: %s',
//                    $result->passed() ? 'PASS' : 'FAIL',
//                    $result->getName(),
//                    $result->getMessage()
//                ),
//                $result->failed() ? 'error' : 'info',
//                ($onlyFails && $result->passed()) ? OutputInterface::VERBOSITY_VERBOSE : null
//            );
//            $this->line(
//                $result->getDisplayData() ?? '',
//                null,
//                $result->failed() ? null : OutputInterface::VERBOSITY_VERBOSE
//            );
//
//            return ($result->skipped())
//                ? $carry
//                : $carry && $result->passed();
//        }, true);
//
//        return $passed ? 0 : 1;
    }

    /**
     * Boots the checks
     */
    protected function bootChecks()
    {
        $this->preflightSteps = config("preflight");
//        $environment = strtolower(App::environment());

//        try {
//            if (! config()->has("preflight.checks.{$environment}")) {
//                throw new NoPreflightChecksDefinedException("No preflight checks defined for this environment ({$environment})!");
//            }
//        } catch (InvalidArgumentException $exception) {
//            // Catch for Laravel 6.x
//            throw new NoPreflightChecksDefinedException("No preflight checks defined for this environment ({$environment})!");
//        }
//        foreach (config("preflight") as $class => $options) {
//            if (is_numeric($class) && is_subclass_of($options, PreflightCheck::class, true)) {
//                $class = $options;
//                $options = [];
//            }
//
//            if (is_array($options)) {
//                $class = $options;
//                $options = $options ?? [];
//            }
//            $this->preflightSteps[] = $options;
//        }
    }
}
