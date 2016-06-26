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
     * Display a listing of the users.
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
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
     * Show the form for creating a new user.
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
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
     * Display the profile of user.
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->is('super.admin') || \Auth::user()->can('user.admin') || (Auth::user()->id == $id)) {
            /* Find user */
            $item = UserModel::findOrFail($id);

            /* Set avatar default for user if user is empty avatar */
            if (empty($item->avatar)) {
                $item->avatar = '160x160_avatar_default.png?t=1';
            }

            return view('back-end.admin.users.profile', compact('item'));
        }
        return redirect('/admin/category');
    }

    /**
     * Show the form for edit a user.
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->is('super.admin')) {
            /* Find user */
            $item = UserModel::findOrFail($id);

            return view('back-end.admin.users.create', compact('item'));
        }
        return redirect('/admin/category');
    }

    /**
     * Call modal change password of user
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('back-end.admin.users.change-password');
    }
}
