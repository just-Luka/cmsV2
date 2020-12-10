<?php

namespace App\Console\Commands\Modules\Views;

use App\Console\Commands\Modules\Root;
use Illuminate\Support\Str;

abstract class BaseView extends Root
{
    private $pathBackend = '/resources/views/backend/modules/';
    private $pathFrontend = '/resources/views/frontend/modules/';

    public function backend(): void
    {
        $path = base_path().$this->pathBackend.Str::plural($this->moduleName);
        mkdir($path);
        $view = fopen($path.'/wrapper.blade.php', 'w');
        fwrite($view, $this->modify());
        fclose($view);
    }

    public function frontend(): void
    {
        $path = base_path().$this->pathFrontend.Str::plural($this->moduleName);
        mkdir($path);
        $view = fopen($path.'/index.blade.php', 'w');
        fwrite($view, $this->modify());
        fclose($view);
    }
}
