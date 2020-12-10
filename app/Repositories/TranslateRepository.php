<?php


namespace App\Repositories;


use App\Contracts\ITranslate;

class TranslateRepository
{
    private $ITranslate;

    /**
     * @param ITranslate $ITranslate
     */
    public function setITranslate(ITranslate $ITranslate): void
    {
        $this->ITranslate = $ITranslate;
    }

    /**
     * @return ITranslate
     */
    public function getITranslate(): ITranslate
    {
        return $this->ITranslate;
    }
}
