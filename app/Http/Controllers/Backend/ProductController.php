<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\RefCategory;
use App\Models\RefMedia;
use App\Models\RefTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Translations\Product as ProductT;

class ProductController extends Controller
{
    private $product;
    private $productT;
    private $category;
    private $brand;
    private $tag;

    private $rules = [
        'slug' => 'required|unique:products|min:2',
    ];

    /**
     * ProductController constructor.
     * @param Request $request
     * @param Product $product
     * @param ProductT $ProductT
     * @param Category $category
     * @param Tag $tag
     */
    public function __construct(Request $request, Product $product, ProductT $ProductT, Category $category, Tag $tag, Brand $brand)
    {
        $this->moduleName = 'products';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->product = $product;
        $this->request = $request;
        $this->productT = $ProductT;
        $this->category = $category;
        $this->brand = $brand;
        $this->tag = $tag;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->product->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';
        $this->data['categories'] = $this->category->getList($this->moduleName)->get();
        $this->data['tags'] = $this->tag->getList($this->moduleName)->get();
        $this->data['brands'] = $this->brand->with('translation')->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $this->request->validate($this->rules);
        $item = $this->product->create($this->data() + ['sort' => $this->product->getMaxSort() + 1]);
        $this->attachCategory($item->id);
        $this->attachTag($item->id);

        return redirect()->route('backend.'.$this->moduleName.'.index', ['locale' => $locale]);
    }



    /**
     * @return array
     */
    private function data()
    {
        return [
            'price'        => $this->request->price,
            'brand_id'     => $this->request->brand,
            'slug'         => $this->request->slug,
            'new_price'    => $this->request->new_price,
            'fake_star'    => $this->request->star,
            'fake_sold'    => $this->request->sold,
            'on_main'      => $this->request->on_main,
            'visible'      => $this->request->visible || 0,
            'image'        => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
        ];
    }

    /**
     * @param $locale
     * @param $id
     * @param RefCategory $refCategory
     * @param RefTag $refTag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id, RefCategory $refCategory, RefTag $refTag)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->product->find($id) ?: abort(404);

        $this->data['categories'] = $this->category->getList($this->moduleName)->get();
        $categoryIds = $refCategory->getList($this->moduleName, $id)->pluck('category_id');
        $this->data['myCategories'] = $this->category->myCategories($categoryIds);

        $this->data['tags'] = $this->tag->getList($this->moduleName)->get();
        $tagIds = $refTag->getList($this->moduleName, $id)->pluck('tag_id');
        $this->data['myTags'] = $this->tag->myTags($tagIds);

        $this->data['brands'] = $this->brand->with('translation')->get();

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
        $item = $this->product->find($id);
        if ($this->request->slug !== $item->slug){
            $this->validate($this->request, $this->rules);
        }
        $item->update($this->data());
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
        $this->product->find($id)->delete();

        return response('Product is deleted successfully', 200);
    }

    /**
     * @param $locale
     * @param $id
     * @param Media $media
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id, Media $media)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->product->find($id) ?: abort(404);
        $this->data['itemContent'] = $this->productT->getItem($locale, $id);
        $this->data['mediaFileData'] = $media->getMediaByRef($this->moduleName, $id);
        $this->data['fileString'] = FileLib::fileToString($this->data['mediaFileData']);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @param RefMedia $refMedia
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
        $itemContent = $this->productT->getItem($locale, $id);
        $requests = [
            'title'      => $this->request->title,
            'desc'       => $this->request->tm,
            'product_id' => $id,
            'lang_slug'  => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->productT->create($requests);

        return redirect()->back()->with('updated', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->product->find($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }

}
