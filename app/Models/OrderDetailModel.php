<?php 
namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_details';

    protected $fillable = ['quantity', 'amount', 'status', 'order_id', 'product_id'];
}