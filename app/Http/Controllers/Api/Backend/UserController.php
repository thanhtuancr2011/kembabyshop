<?php

namespace App\Http\Controllers\Api\Backend;

use Illuminate\Http\Request;

use Auth;
use Input;
use App\Http\Requests;
use App\Models\UserModel;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        /* Get all data input */
        $data = $request->all();

        /* Get remember token */
        $data['remember_token'] = csrf_token();

        /* Init user model to call function in it */
        $userModel = new UserModel;
        
        /* Call function create new user */
        $user = $userModel->createNewUser($data);

        $status = 0;

        /* If user was created */
        if ($user) {
            $status = 1;
        }

        /* Return user */
        return new JsonResponse(['user'=>$user, 'status'=>$status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $status = 0;

        /* Get all data input */
        $data = $request->all();

        /* Find user */
        $user = UserModel::findOrFail($id);

        /* Init user model to call function in it */
        $userModel = new UserModel;

        /* Call function create new user */
        $user = $user->updateUser($data);

        /* If user was created */
        if ($user) {
            $status = 1;
        }

        /* Return user */
        return new JsonResponse(['user' => $user, 'status' => $status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Find user */
        $user = UserModel::findOrFail($id);

        /* Delete user */
        $status = $user->delete();

        return new JsonResponse(['status'=>$status]);

    }

    /**
     * [updateProfile description]
     * @param  Request $request [description]
     * @param  [type]  $userId  [description]
     * @return [type]           [description]
     */
    public function updateProfile($userId, UserFormRequest $request)
    {
        /* If user has role or permission or update self */ 
        if(\Auth::user()->is('super_admin') || \Auth::user()->can('user_admin') || \Auth::user()->id == $userId ){
            
            /* Get all data */
            $data = $request->all();
            
            /* Find user */
            $user = UserModel::findOrFail($userId);
            
            /* Call function update user */
            $result = $user->updateUser($data);
            
            return new JsonResponse($result);
        }
    }

    /**
     * Change avatar for user
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * @param  Request $request Request
     * @param  String  $id      Id of user 
     * @return Array            
     */
    public function changeAvatar(Request $request, $id = null)
    {
        // If user has role or permission or update self
        if(\Auth::user()->is('super_admin') || \Auth::user()->can('user_admin') || \Auth::user()->id == $id ){
            /* Get all data input */ 
            $data = $request->all();
            
            /* Find user */ 
            $user = UserModel::find($id);

            /* If has file image and has user */ 
            if(!empty($data['file']) && !empty($user)){

                // Endcode and save image image
                $data['file'] = str_replace('data:image/png;base64,', '', $data['file']);
                $data['file'] = str_replace(' ', '+', $data['file']);
                $result = FileService::saveAvatar(base64_decode($data['file']),$id);
                $status = 0;
                if(!is_array($result)){
                    $user->avatar = $result;
                    $user->save();
                    return  new JsonResponse(['status' => 1, 'item' => $user]);
                }else{
                    return  new JsonResponse(['status' => 0, 'error' => $result['error']]);
                }
            }
            return new JsonResponse(['status' => 0]);
        }
    }

    public function changePassword(Request $request, $id)
    {
        // If user has role or permission or update self
        if(\Auth::user()->is('super_admin') || \Auth::user()->can('user_admin') || \Auth::user()->id == $id ){
            $status = 0;
            
            /* Get all data input */ 
            $data = $request->all();

            // Find user
            $user = UserModel::find($id);

            /* Update user */
            $user->password = bcrypt($data['password']['password']);
            $status = $user->save();

            return new JsonResponse(['status' => $status]);
        }
    }

    /**
     * Check email user
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * @param  Request $request Request
     * @return Json           
     */
    public function checkEmailProfile(Request $request)
    {
        $data = $request->all();
        /* Find user */

        $user = UserModel::find($data['id']);

        /* Call function check unique email */
        $status = $user->checkUniqueEmailUser($data);

        return new JsonResponse(['status' => $status]);
    }
}
