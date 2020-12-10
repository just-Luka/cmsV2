<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Models\Event;
use App\Models\Translations\Event as EventT;

use Illuminate\Http\Request;

class EventController extends Controller
{
    private $event;
    private $eventT;

    /**
     * EventController constructor.
     * @param Request $request
     * @param Event $event
     * @param EventT $eventT
     */
    public function __construct(Request $request, Event $event, EventT $eventT)
    {
        $this->moduleName = 'events';
        $this->templateName = 'modules.' . $this->moduleName . '.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['shapes'] = config('settings.root.event_shapes');
        $this->data['attachments'] = config('settings.root.event_attachments');
        $this->request = $request;
        $this->event = $event;
        $this->eventT = $eventT;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['list'] = $this->event->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $this->validate($this->request, ['concrete_attachment' => 'required']);
        $this->event->create($this->data() + [
                'sort' => $this->event->getMaxSort() + 1,
                'attachment'    => $this->request->attachment,
                'attachment_id' => $this->request->concrete_attachment
            ]);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'shape'         => $this->request->shape,
            'visible'       => $this->request->visible,
            'image'         => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
        ];
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id)
    {
        $this->templateName .= 'edit';
        $this->data['eventData'] = $this->event->find($id) ?: abort(404);

        return view($this->templateName, $this->data);
    }

    public function update($locale, $id)
    {
        $this->event->find($id)->update($this->data());

        return redirect()->back()->with('updated', 'Event updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->event->find($id)->delete();

        return response('Event deleted successfully', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id)
    {
        $this->templateName .= 'content_edit';
        $this->data['eventData'] = $this->event->find($id) ?: abort(404);
        $this->data['eventTransData'] = $this->eventT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function transAction($locale, $id)
    {
        $this->validate($this->request, ['meta_title' => 'max:255', 'title' => 'max:255']);
        $eventTransData = $this->eventT->getItem($locale, $id);
        $eventTransNewData = [
            'title' => $this->request->title,
            'meta_title' => $this->request->meta_title,
            'content' => $this->request->tm,
            'event_id' => $id,
            'lang_slug' => $locale,
        ];
        $eventTransData ? $eventTransData->update($eventTransNewData) : $this->eventT->create($eventTransNewData);

        return redirect()->back()->with('updated', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $event = $this->event->find($id);
        $event->visible = $this->request->action ? 1 : 0;
        $event->save();

        return response('Event visible updated successfully', 200);
    }
}
