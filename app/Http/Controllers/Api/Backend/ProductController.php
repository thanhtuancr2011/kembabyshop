<?php

namespace App\Http\Controllers\Api\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Requests;
use App\Models\ProductModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;

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
     * Create new product
     * 
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  ProductFormRequest $request Form Request
     * 
     * @return Response
     */
    public function store(Request $request)
    {
        $status = 0;

        $data = $request->all();

        $productModel = new ProductModel;

        $product = $productModel->createNewProduct($data);

        if ($product) {
            $status = 1;
        }

        return new JsonResponse(['status' => $status, 'product' => $product]);
    }

    /**
     * Create new image for product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Request $request Request
     * 
     * @return Int              Status true or false
     */
    public function createImageProduct($id, Request $request) 
    {
        $data = $request->all();

        $images = $data['fileUploaded'];

        $product = ProductModel::findOrFail($id);

        $status = $product->createImageProduct($images);

        return new JsonResponse(['status' => $status, 'product' => $product]);
    }

    /**
     * Edit product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Int                 $id      Product id
     * @param  CategoryFormRequest $request Form request
     * 
     * @return Response                       
     */
    public function update($id, Request $request)
    {
        $status = 0;

        $redirect = 0;

        $data = $request->all();

        $product = ProductModel::findOrFail($id);

        $status = $product->updateProduct($data);
        
        return new JsonResponse(['status' => $status, 'product' => $product]);
    }

    /**
     * Remove the product from storage.
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 0;

        $product = ProductModel::findOrFail($id);

        $status = $product->deleteProduct();

        return new JsonResponse(['status' => $status]);
    }
}
