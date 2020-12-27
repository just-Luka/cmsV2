<?php

namespace App\Http\Controllers\Backend;

use App\Facades\CategoryFacade;
use App\Facades\FileLib;
use App\Facades\TagFacade;
use App\Http\Controllers\Traits\AttachableTrait;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\RefMedia;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Translations\Product as ProductT;
use Illuminate\Validation\Rule;

class ProductController extends BaseController
{
    use AttachableTrait;

    /**
     * ProductController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'products';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->request = $request;
        $this->setModel(new Product());
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->model->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';
        $this->data['categories'] = (new Category())->getList($this->moduleName)->get();
        $this->data['tags'] = (new Tag())->getList($this->moduleName)->get();
        $this->data['brands'] = (new Brand())->with('translation')->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale)
    {
        $item = $this->model->create($this->data() + ['sort' => $this->model->getSort()]);
        $this->attachCategory($item->id);
        $this->attachTag($item->id);

        return redirect()->route('backend.'.$this->moduleName.'.index', ['locale' => $locale]);
    }


    /**
     * @param null $id
     * @return array
     */
    private function data($id=null)
    {
        $this->request->validate([
            'slug' => ['required', 'min:2', 'max:255', Rule::unique('products')->ignore($id)],
        ]);

        return [
            'price'     => $this->request->price,
            'brand_id'  => $this->request->brand,
            'slug'      => $this->request->slug,
            'new_price' => $this->request->new_price,
            'fake_star' => $this->request->star,
            'fake_sold' => $this->request->sold,
            'on_main'   => $this->request->on_main,
            'visible'   => $this->request->visible,
            'image'     => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
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
        $this->data['item'] = $this->model->findOrFail($id);
        $this->data['categories'] = (new Category())->getList($this->moduleName)->get();
        $this->data['myCategories'] = (new CategoryFacade($this->moduleName))->relatedItems($id);
        $this->data['tags'] = (new Tag())->getList($this->moduleName)->get();
        $this->data['myTags'] = (new TagFacade($this->moduleName))->relatedItems($id);
        $this->data['brands'] = (new Brand())->with('translation')->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $item = $this->model->findOrFail($id);

        $item->update($this->data($item->id));
        $this->attachCategory($id);
        $this->attachTag($id);
        return redirect()->back()->with('updated', 'Product updated successfully!');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->model->findOrFail($id)->delete();

        return response('Product is deleted successfully', 200);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->model->findOrFail($id);
        $this->data['itemContent'] = (new ProductT())->getItem($locale, $id);
        $this->data['mediaFileData'] = (new Media())->getMediaByRef($this->moduleName, $id);
        $this->data['fileString'] = FileLib::fileToString($this->data['mediaFileData']);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id, RefMedia $refMedia)
    {
        $referenceMedia = $refMedia->getList($this->moduleName, $id);

        if ($referenceMedia->get()) {
            $referenceMedia->delete();
        }

        if ($this->request->has('filepath')){
            $multipleFiles = explode('|||', $this->request->filepath);
            foreach ($multipleFiles as $file)
                $refMedia->makeConnection($file, $this->moduleName, $id);
        }
        $this->setModel(new ProductT());
        $itemContent = $this->model->getItem($locale, $id);
        $requests = [
            'title'      => $this->request->title,
            'desc'       => $this->request->tm,
            'product_id' => $id,
            'lang_slug'  => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->model->create($requests);

        return redirect()->back()->with('updated', '200');
    }
}
