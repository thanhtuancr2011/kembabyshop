<?php

namespace App\Http\Controllers\Api\Frontend;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Request $request Request
     * 
     * @return Response           
     */
    public function searchProduct (Request $request)
    {
        $data = $request->all();

        $productModel = new ProductModel;

        $products = $productModel->getProductWithName($data['productName']);

        return redirect('/search')->with('products', $products); 
    }
}
