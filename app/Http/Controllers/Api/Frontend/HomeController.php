<?php

namespace App\Http\Controllers\Api\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

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
}
