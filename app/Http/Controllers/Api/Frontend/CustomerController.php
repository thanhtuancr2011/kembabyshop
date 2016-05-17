<?php

namespace App\Http\Controllers\Api\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Services\MailService;
use App\Services\CacheService;
use App\Models\UserModel;
use App\Http\Requests\UserFormRequest;
use Auth;

class CustomerController extends Controller
{
    /**
     * Create new customer
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  CustomerFormRequest $request Form request
     * 
     * @return Response                       
     */
    public function store(UserFormRequest $request) 
    {
        $status = 0;

        $data = $request->all();

        /* Get remember token */
        $data['remember_token'] = csrf_token();

        /* Init user model to call function in it */
        $userModel = new UserModel;

        /* Call function create new user */
        $customer = $userModel->createNewCustomer($data);

        if ($customer) {
            $status = 1;
            $customer->password = $data['password'];
            MailService::sendEmailCreateAccount($customer);

            // Login
            Auth::login($customer);
        }

        return new JsonResponse(['status' => $status, 'customer' => $customer]);
    }

    /**
     * Login customer
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Request $request Request
     * 
     * @return Response           
     */
    public function postLogin (Request $request)
    {
        $data = $request->all();

        $customer = UserModel::where('email', $data['email'])->first();

        // If not exists email
        if (empty($customer)) {
            return new JsonResponse (['status' => 0, 'msg' => 'Không tìm thấy email trong hệ thống.']);
        } 

        $checkValidPassword = \Hash::check($data['password'], $customer->password);
            
        // If invalid password
        if (!$checkValidPassword) {
            return new JsonResponse (['status' => 0, 'msg' => 'Mật khẩu bạn nhập chưa đúng.']);
        }

        // Login
        Auth::login($customer);

        // Login success
        return new JsonResponse (['status' => 1, 'msg' => 'Đăng nhập thành công.', 'customer' => $customer]);
    }

    /**
     * Login customer with facebook
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Request $request Request
     * 
     * @return Void           
     */
    public function postLoginFacebook (Request $request)
    {
        $data = $request->all();

        $customerModel = new UserModel;

        $existsEmail = $customerModel->checkExistsEmail($data['email']);

        if ($existsEmail) {
            $customer = UserModel::where('email', $data['email'])->first();
            Auth::login($customer);
            return new JsonResponse (['status' => 1, 'msg' => 'Đăng nhập thành công.', 'customer' => $customer]);
        }

        /* Get remember token */
        $data['remember_token'] = csrf_token();

        $hash = substr(explode('/',md5(uniqid().time()))[0], 0 ,10);

        $data['password'] = substr($hash , 0 ,7);

        /* Call function create new user */
        $customer = $customerModel->createNewCustomer($data);

        // Send email to user
        if ($customer) {
            $customer->password = $data['password'];
            MailService::sendEmailCreateAccount($customer);
        }

        // Login
        Auth::login($customer);

        // Login success
        return new JsonResponse (['status' => 1, 'msg' => 'Đăng nhập thành công.', 'customer' => $customer]);
    }

    /**
     * Send email to customer purchase
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Int $id User id
     * 
     * @return Response     
     */
    public function sendEmailToCustomerPurchase ($id)
    {
        $customer = UserModel::find($id);

        // Send email to customer
        MailService::sendEmailToCustomerPurchase($customer);

        $orderModel = new OrderModel;

        // Call function create new order
        $order = $orderModel->createNewOrder($customer->id);

        if ($order) {
            $order->updateStatusForOrderDetail();
        }

        // Delete cart
        destroyCart();

        return new JsonResponse (['status' => 1]);
    }
}
