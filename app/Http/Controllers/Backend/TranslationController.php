<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Language;
use App\Models\Translation;
use App\Models\TranslationDuplicate;
use App\Models\Translations\Translation as TranslationT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TranslationController extends Controller
{
    private $translationT;
    private $translation;

    /**
     * TranslationController constructor.
     * @param Request $request
     * @param TranslationT $translationT
     * @param Translation $translation
     */
    public function __construct(Request $request, TranslationT $translationT, Translation $translation)
    {
        $this->moduleName = 'translation';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['languages'] = Language::getList();
        $this->translationT = $translationT;
        $this->translation = $translation;
        $this->request = $request;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';

        $this->data['languageCount'] = $this->data['languages']->count();
        /* TODO remove that view! */
        $this->data['wordsWithLocale'] = DB::table('translation_duplicates')->pluck('alternative', 'translation_id');
        $this->data['current'] = ['side' => $this->request->side, 'sort' => $this->request->sort];
        $this->data['items'] = $this->translation
             ->getList($this->data['current']['side'], $this->data['current']['sort'])
             ->paginate(self::PAG_NUM)
             ->appends($this->data['current']);

        return view($this->templateName,$this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';

        return view($this->templateName,$this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $item = $this->translation->create($this->data() + ['sort' => $this->translation->getSort()]);
        $this->translationTAction($item->id);

        return redirect()->back()->with('created', 'translation created successfully');
    }

    /**
     * @param null $id
     * @return array
     */
    private function data($id=null)
    {
        $this->request->validate([
            'key' => ['required', 'max:255', Rule::unique('translation')->ignore($id)],
        ]);

        return [
            'key' => $this->request->key,
            'is_backend' => $this->request->is_backend == 1 ? 1 : 2
        ];
    }

    /**
     * @param $id
     */
    private function translationTAction($id)
    {
        foreach ($this->request->except(['key', '_token', 'is_backend']) as $keyLang => $meaning) {
            if (!$meaning){
                continue;
            }

            $getRow = $this->translationT->getItem($keyLang, $id);

            if($getRow){
                $getRow->means = $meaning;
                $getRow->save();
            }else {
                $this->translationT->create([
                    'lang_slug'      => $keyLang,
                    'means'          => $meaning,
                    'translation_id' => $id,
                ]);
            }
        }
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->translation->findOrFail($id);
        $this->data['list'] = $this->translationT->where('lang_slug', 'like', '%')->where('translation_id', $id)->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($locale, $id)
    {
        $item = $this->translation->findOrFail($id);
        $item->update($this->data($item->id));
        $this->translationTAction($id);

        return redirect()->back()->with('updated', 'translation updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($locale, $id)
    {
        $this->translation->findOrFail($id)->delete();

        return redirect()->back()->with('deleted', 'translation deleted successfully');
    }
}
