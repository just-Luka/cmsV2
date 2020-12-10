<?php


namespace App\Http\ViewComposers;


use App\Models\Event;
use Illuminate\View\View;

class OfferComposer
{
    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        $event = new Event();
        $eventData = $event->getFrontList();

        return $view->with('eventData', $eventData);
    }
}
