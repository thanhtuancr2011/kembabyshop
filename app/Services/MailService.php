<?php 

namespace App\Services;

use Carbon\Carbon;
use Mail;

class MailService
{
    /**
     * Send email to customer purchase
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Object $customer Customer
     * 
     * @return Void           
     */
    public static function sendEmailToCustomerPurchase ($customer)
    {
        $data['carts'] = getCarts();                    // Get cart
        $data['customer'] = $customer;                  // Customer
        $data['priceTotal'] = getPriceTotal();          // Total price
        $data['date'] = Carbon::now()->toDateString();

        $contactEmail = $customer->email;
        $contactName = $customer->last_name . ' ' . $customer->first_name;
        $contactPhone = $customer->phone;
        $dateCreated = $data['date'];

        Mail::send('front-end.emails.purchase.index', $data, function($message) use ($contactEmail, $contactName, $contactPhone, $dateCreated) {
            $message->to($contactEmail, $contactName)
                    ->subject(
                        'KembaybyShop.com.vn - Thông báo đơn hàng - ' . $contactName . 
                        ' - ' . $contactPhone . ' - ' . $dateCreated

                    );
        });
    }

    /**
     * Send email to customer created account
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Object $customer Customer
     * 
     * @return Void           
     */
    public static function sendEmailCreateAccount ($customer)
    {
        $data['customer'] = $customer;                  // Customer
        $data['date'] = Carbon::now()->toDateString();

        $contactEmail = $customer->email;
        $contactName = $customer->last_name . ' ' . $customer->first_name;
        $contactPhone = $customer->phone;
        $dateCreated = $data['date'];

        Mail::send('front-end.emails.configurator.index', $data, function($message) use ($contactEmail, $contactName, $contactPhone, $dateCreated) {
            $message->to($contactEmail, $contactName)
                    ->subject(
                        'KembaybyShop.com.vn - Thông báo tạo tài khoản - ' . $contactName . ' - ' . $dateCreated
                    );
        });
    }
}