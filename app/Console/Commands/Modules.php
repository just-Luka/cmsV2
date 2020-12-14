<?php

namespace App\Console\Commands;

use App\Console\Commands\Modules\App\Application;
use App\Console\Commands\Modules\Factory\BackendFactory;
use App\Console\Commands\Modules\Factory\FrontendFactory;
use Illuminate\Console\Command;

class Modules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {moduleName} {--side=backend}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new module!';

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
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        $app = new Application(new BackendFactory(), $this->argument('moduleName'));

        switch ($this->option('side')){
            case 'backend':
                $app->createController()->backend();
                $app->createView()->backend();
                break;
            case 'frontend':
                $app->setFactory(new FrontendFactory());
                $app->createController()->frontend();
                $app->createView()->frontend();
                break;
            case 'both':
                $app->createController()->backend();
                $app->createView()->backend();
                $app->setFactory(new FrontendFactory());
                $app->createController()->frontend();
                $app->createView()->frontend();
                break;
            default:
                throw new \Exception('incorrect --side parameter, try : --side=backend, --side=frontend or --side=both');
        }
        /* TODO success message! */
        echo "success\n";
        return 0;
    }
}
