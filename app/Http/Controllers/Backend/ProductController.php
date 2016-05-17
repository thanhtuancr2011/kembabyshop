<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View all products
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Void 
     */
    public function index()
    {
        if (Auth::user()->is('super.mod') || Auth::user()->is('super.admin')) {

            $products = ProductModel::all();
            
            $listsMapCategories = CategoryModel::lists('name', 'id');

            return view('back-end.admin.products.index', compact('products', 'listsMapCategories'));
        }

        return redirect('/');
    }

    /**
     * Create new product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Void 
     */
    public function create()
    {
        if (Auth::user()->is('super.mod') || Auth::user()->is('super.admin')) {

            $product = new ProductModel;

            $categoryModel = new CategoryModel;

            // Call function get tree category
            $categoriesTree = $categoryModel->getCategoriesTree();
            $categoriesTree = $categoriesTree[0]['subFolder'];

            $categorySelected = $categoryModel;
            $categorySelected['name'] = 'Danh mục';
            
            return view('back-end.admin.products.create', compact('product', 'categoriesTree', 'categorySelected'));
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Edit product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Int $id Product id
     * 
     * @return Void     
     */
    public function edit($id)
    {
        if (Auth::user()->is('super.mod') || Auth::user()->is('super.admin')) {

            // Category edit
            $product = ProductModel::findOrFail($id);

            // Init model
            $categoryModel = new CategoryModel;

            // Call function get tree category
            $categoriesTree = $categoryModel->getCategoriesTree();
            $categoriesTree = $categoriesTree[0]['subFolder'];

            // Category selected
            $categorySelected = CategoryModel::findOrFail($product->category_id);

            // Add array ancestor_ids for category you want delete
            $ancestor_ids = [];
            $categoryModel->getAncestorCategoryIds($categorySelected, $ancestor_ids);
            $categorySelected['ancestor_ids'] = $ancestor_ids;

            $filesUpload = $product->images;

            return view('back-end.admin.products.edit', compact('product', 'categoriesTree', 'categorySelected', 'filesUpload'));
        }

        return redirect('/');
    }
}
