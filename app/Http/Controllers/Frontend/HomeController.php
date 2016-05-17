<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productModel = new ProductModel;
        
        // Get list product with categoryid
        $listProductMapCategoryId = $productModel->getListProductMapCategoryId();

        // Get products sale
        $saleProducts = $productModel->getSaleProducts();

        // Get new products
        $newProducts = $productModel->getNewProducts();

        return view('front-end.index', compact('listProductMapCategoryId', 'saleProducts', 'newProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Get search products
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  String $name Data name search
     * 
     * @return Response       
     */
    public function getSearch ($name) 
    {
        $productModel = new ProductModel;

        $products = $productModel->getProductWithName($name);

        return view('front-end.search.index', compact('products'));
    }
}
