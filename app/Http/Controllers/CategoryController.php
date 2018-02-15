<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

use CodeCommerce\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * @var Category
     */
    private $categoryModel;


    /**
     * CategoryController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {

        $this->categoryModel = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryModel->paginate(15);

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {

        $data = $request->all();

        $category = $this->categoryModel->fill($data);
        $category->save();

        return redirect()->route('categories');

    }

    public function edit($id)
    {

        $category = $this->categoryModel->find($id);

        return view('category.edit', compact('category'));

    }

    public function update(CategoryRequest $request, $id)
    {
        $this->categoryModel->find($id)->update($request->all());

        return redirect()->route('categories');
    }

    public function destroy($id)
    {
        $category = $this->categoryModel->find($id);
        $category->delete();

        return redirect()->route('categories');
    }


}
