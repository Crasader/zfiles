<?php

/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 8/29/2017
 * Time: 1:13 AM
 */

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class TestCronjob extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test:cron';

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
     * @return mixed
     */
    public function fire()
    {
        $tc = new TestCron();

        $tc->value = rand(1, 100);

        $tc->save();

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}