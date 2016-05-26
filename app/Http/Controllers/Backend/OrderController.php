<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderDetailModel;
use App\Http\Controllers\Controller;


class OrderController extends Controller
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

            $orderDetailModel = new OrderDetailModel;

            $listOrders = $orderDetailModel->getListsOrdersDetail();

            return view('back-end.admin.orders.index', compact('listOrders'));
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
        }

        return redirect('/');
    }
}
