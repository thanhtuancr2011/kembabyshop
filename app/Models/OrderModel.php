<?php 
namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'orders';

    protected $fillable = ['amount', 'status', 'user_id'];

	/**
     * Relationship product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Voids 
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetailModel', 'order_id');
    }

    /**
     * Create new order and order detail
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Int $customerId Id of customer
     * 
     * @return Object          Order
     */
	public function createNewOrder($customerId)
	{
		$dataOrder['status'] = 0;             		// Order status
		$dataOrder['amount'] = getPriceTotal();		// Total price of order
		$dataOrder['user_id'] = $customerId;		// Customer id

		// Create order
		$order = $this->create($dataOrder);

		$carts = getCarts();

		foreach ($carts as $key => $cart) {

			$dataOrderDetail = [];
			$dataOrderDetail['amount'] = $cart->qty * $cart->price;  // Total price of order
			$dataOrderDetail['status'] = 0;							 // Said the state has sent mail
			$dataOrderDetail['quantity'] = $cart->qty;				 // Total item of cart product's
			$dataOrderDetail['product_id'] = $cart->id;				 // Product id

			// Create order detail
			$status = $order->orderDetails()->create($dataOrderDetail);
		}

		return $order;
	}

	/**
	 * After send email create order for user then update status of order detail
	 *
	 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
	 * 
	 * @return Void 
	 */
	public function updateStatusForOrderDetail()
	{
		$this->orderDetails()->update(['status' => 1]);
	}
}