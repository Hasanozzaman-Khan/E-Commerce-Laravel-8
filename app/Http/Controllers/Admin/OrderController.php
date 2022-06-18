<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class OrderController extends Controller
{

    public function index()
    {
        $result['orders'] =DB::table('orders')
            ->select('orders.id', 'orders.name', 'orders.email', 'orders.mobile', 'orders_status.orders_status', 'orders.payment_type', 'orders.payment_status', 'orders.payment_id', 'orders.total_amt', 'orders.added_on')
            ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
            ->get();
// prx($result);
        return view('admin.order', $result);
    }



    public function order_detail(Request $request, $id)
    {
        $result['orders_detail'] = DB::table('orders_details')
            ->select('orders.*', 'orders_status.orders_status', 'orders_details.price', 'orders_details.qty', 'products.name as pname', 'products_attr.attr_image', 'sizes.size', 'colors.color')
            ->leftJoin('orders','orders.id','=','orders_details.orders_id')
            ->leftJoin('products_attr','products_attr.id','=','orders_details.products_attr_id')
            ->leftJoin('products','products.id','=','products_attr.products_id')
            ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftJoin('colors','colors.id','=','products_attr.color_id')
            ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
            ->where(['orders.id'=>$id])
            ->get();
// prx($result['orders_detail']);
        return view('admin.order_detail', $result);
    }


}
