<?php

namespace App\Console\Commands\Modules\Controllers;

use App\Console\Commands\Modules\Root;

abstract class BaseController extends Root
{
    private $pathBackend = '/app/Http/Controllers/Backend/';
    private $pathFrontend = '/app/Http/Controllers/Frontend/';

    public function backend(): void
    {
        $path = base_path().$this->pathBackend;
        $controller = fopen($path.ucfirst($this->moduleName.'Controller.php'), 'w');
        fwrite($controller, $this->modify());
        fclose($controller);
    }

    public function frontend(): void
    {
        $path = base_path().$this->pathBackend;
        $controller = fopen($path.ucfirst($this->moduleName.'Controller.php'), 'w');
        fwrite($controller, $this->modify());
        fclose($controller);
    }
}
