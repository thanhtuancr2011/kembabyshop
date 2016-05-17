<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Auth;

class UserController extends Controller
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
        if (Auth::user()->is('super.admin')) {
            /* Init user model to call function in it */
            $userModel = new UserModel;
            /* Call function get all user */
            $users = $userModel->getAllUser();

            return view('back-end.admin.users.index', compact('users'));
        }
        return redirect('/admin/category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->is('super.admin')) {
            /* Init user */
            $item = new UserModel;
            return view('back-end.admin.users.create', compact('item'));
        }
        return redirect('/admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->is('super.admin') || (Auth::user()->id == $id)) {
            /* Init user */
            $item = UserModel::findOrFail($id);
            if (empty($item->avatar)) {
                $item->avatar = '160x160_avatar_default.png?t=1';
            }
            return view('back-end.admin.users.profile', compact('item'));
        }
        return redirect('/admin/category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->is('super.admin')) {
            /* Init user */
            $item = UserModel::findOrFail($id);

            return view('back-end.admin.users.create', compact('item'));
        }
        return redirect('/admin/category');
    }

    /**
     * Call modal change password of user
     * @return [type] [description]
     */
    public function changePassword()
    {
        return view('back-end.admin.users.change-password');
    }
}
