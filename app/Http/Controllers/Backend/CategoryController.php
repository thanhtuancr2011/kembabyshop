<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Models\CategoryModel;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is('super.mod') || Auth::user()->is('super.admin')) {

            $categories = CategoryModel::all();

            $listsMapCategories = CategoryModel::lists('name', 'id');
            
            return view('back-end.admin.categories.index', compact('categories', 'listsMapCategories'));
        }
        return redirect('/');
    }

    /**
     * Create new category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Void 
     */
    public function create()
    {
        if (Auth::user()->is('super.mod') || Auth::user()->is('super.admin')) {

            $category = new CategoryModel;

            // Call function get tree category
            $categoriesTree = $category->getCategoriesTree();

            $categorySelected = $category->first();

            $ancestor_ids = [];
            $category->getAncestorCategoryIds($categorySelected, $ancestor_ids);
            $categorySelected['ancestor_ids'] = $ancestor_ids;
            
            return view('back-end.admin.categories.create', compact('category', 'categoriesTree', 'categorySelected'));
        }
        return redirect('/');
    }

    /**
     * Edit category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Int $id Category id
     * 
     * @return Void     
     */
    public function edit($id)
    {
        if (Auth::user()->is('super.mod') || Auth::user()->is('super.admin')) {
            // Init model
            $categoryModel = new CategoryModel;
            
            // Call function get tree category
            $categoriesTree = $categoryModel->getCategoriesTree();

            // Category edit
            $category = CategoryModel::findOrFail($id);

            // Category parent
            $categorySelected = CategoryModel::findOrFail($category->parent_id);

            if (empty($categorySelected)) {
                $categorySelected = $categoryModel->first();
            }

             // Add array ancestor_ids for category you want delete
            $ancestor_ids = [];
            $categoryModel->getAncestorCategoryIds($categorySelected, $ancestor_ids);
            $categorySelected['ancestor_ids'] = $ancestor_ids;

            $filesUpload = $category->images;

            return view('back-end.admin.categories.edit', compact('category', 'categoriesTree', 'categorySelected', 'filesUpload'));
        }

        return redirect('/');
    }
}
