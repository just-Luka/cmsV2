<?php


namespace App\Console\Commands\Modules;


abstract class Root
{
    protected $moduleName;

    public abstract function backend(): void;
    public abstract function frontend(): void;
    public abstract function template(): String;

    public function __construct($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    /**
     * @return mixed|string|string[]
     */
    protected function modify()
    {
        return str_replace('dollar|', '$', $this->template());
    }
}
