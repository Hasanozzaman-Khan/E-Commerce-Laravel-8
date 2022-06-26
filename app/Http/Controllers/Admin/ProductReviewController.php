<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function index()
    {
            $result['product_review'] =
                DB::table('product_review')
                ->leftJoin('customers','customers.id','=','product_review.customers_id')
                ->leftJoin('products','products.id','=','product_review.product_id')
                // ->where(['product_review.status'=>1])
                ->orderBy('product_review.added_on','DESC')
                ->select('product_review.id', 'product_review.rating', 'product_review.review', 'product_review.status', 'product_review.added_on', 'customers.name', 'products.name as pname')
                ->get();
// prx($result);
        return view('admin.product_review', $result);
    }



    public function update_product_review_status(Request $request, $status, $id)
    {
        DB::table('product_review')
            ->where(['id'=>$id])
            ->update(['status'=>$status]);

        return redirect('admin/product_review');
    }
}
