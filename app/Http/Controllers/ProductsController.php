<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use CodeCommerce\Tag;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    private $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productModel->paginate(15);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $categories = $category->lists('name','id');

        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ProductRequest $request)
    {

        $inputTags = explode(',',$request->get('tags'));

        $product = $this->productModel->fill($request->all());
        $product->save();

        $this->storeTag($inputTags,$product->id);

        return redirect()->route('products');

    }

    private function storeTag($inputTags, $id)
    {

        $tag = new Tag();

        $countTags = count($inputTags);

        foreach ($inputTags as $key => $value) {
            $newTag = $tag->firstOrCreate(["name" => trim($value)]);
            $idTags[] = $newTag->id;
        }

        $product = $this->productModel->find($id);
        $product->tags()->sync($idTags);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {

        $categories = $category->lists('name','id');

        $product = $this->productModel->find($id);
        $tags = implode(',', $product->tags()->lists('name')->toArray());

        return view('products.edit', compact('product','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProductRequest $request, $id)
    {

        $inputTags = explode(",", $request->get('tags'));

        $this->productModel->find($id)->update($request->all());
        $this->storeTag($inputTags,$id);
        return redirect()->route('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productModel->find($id)->delete();
        return redirect()->route('products');
    }

    public function images($id)
    {
        $product = $this->productModel->find($id);
        return view('products.images', compact('product'));
    }

    public function createImages($id)
    {
        $product = $this->productModel->find($id);
        return view('products.create_images', compact('product'));
    }

    public function storeImages(Requests\ProductImageRequest $request, $id, ProductImage $productImage)
    {
        $file = $request->file('image');

        $extension = $file->getClientOriginalExtension();

        $product = $productImage->create(['product_id' => $id, 'extension' => $extension]);
        $product->save();

        Storage::disk('public_local')->put($product->id.'.'.$extension,File::get($file));

        return redirect()->route('products.images', ['id' => $id]);

    }

    public function destroyImages(ProductImage $productImage, $id)
    {

        $image = $productImage->find($id);

        if(file_exists(public_path() . '/uploads/' . $image->id.'.'.$image->extension))
        {
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
        }

        $product = $image->product;
        $image->delete();

        return redirect()->route('products.images', ['id' => $product->id]);


    }

}
