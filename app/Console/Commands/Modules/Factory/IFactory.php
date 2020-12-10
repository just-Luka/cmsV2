<?php

namespace App\Console\Commands\Modules\Factory;

use App\Console\Commands\Modules\Controllers\BaseController;
use App\Console\Commands\Modules\Views\BaseView;

interface IFactory
{
    // Don't make as abstract
    public function makeController($moduleName): BaseController;
    public function makeView($moduleName): BaseView;
}
