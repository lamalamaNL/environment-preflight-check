<?php

namespace Lamalama\PreflightCheck\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

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
    protected $description = 'Checks that the application has all needed .env values';


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
        $errors = [];

        foreach ($checks as $check) {
            $outputStyle = new OutputFormatterStyle('black', 'red', ['bold', 'blink']);

            if (!$onlyFails && env($check) === '') {
                ++$failed;
                $errors[] = $check;
            }
        }
            if ($errors) {
                $output->getFormatter()->setStyle('fire', $outputStyle);
                $output->writeln('<fire>[FAIL] Configuration: Missing Environment Values.</>');
                foreach ($errors as $error) {
                    $output->writeln("<fire>$error</fire>");
                }

            }

        if ($failed === 0) {
            $outputStyle = new OutputFormatterStyle('black', 'green', ['bold', 'blink']);
            $output->getFormatter()->setStyle('fire', $outputStyle);
            $output->writeln('<fire>All Checks have passed, you can deploy!</>');
        }

    }
}
