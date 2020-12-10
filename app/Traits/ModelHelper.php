<?php

namespace App\Traits;

trait ModelHelper
{
    /**
     * @return int|mixed
     */
    public function getMaxSort()
    {
        $sortNumbers = $this->pluck('sort')->toArray();

        return $sortNumbers ? max($sortNumbers) : 0;
    }
}
