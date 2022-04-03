<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

    public function index(Request $request)
    {
// Product section
        $result['home_categories'] = DB::table('categories')
                ->where(['status'=>1])
                ->where(['is_home'=>1])
                ->get();


        foreach ($result['home_categories'] as $list) {
            $result['home_categories_product'][$list->id] =
                DB::table('products')
                ->where(['status'=>1])
                ->where(['category_id'=>$list->id])
                ->get();

            foreach ($result['home_categories_product'][$list->id] as $list1) {
                $result['home_product_attr'][$list1->id] =
                    DB::table('products_attr')
                    ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                    ->leftJoin('colors','colors.id','=','products_attr.color_id')
                    ->where(['products_attr.products_id'=>$list1->id])
                    ->get();
            }

        }

// Brand section
        $result['home_brand'] = DB::table('brands')
                ->where(['status'=>1])
                ->where(['is_home'=>1])
                ->get();

// Special offers
    // featured
        $result['home_featured_product'][$list->id] =
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_featured'=>1])
            ->get();

        foreach ($result['home_featured_product'][$list->id] as $list1) {
            $result['home_featured_product_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }

    // Tranding
        $result['home_tranding_product'][$list->id] =
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_tranding'=>1])
            ->get();

        foreach ($result['home_tranding_product'][$list->id] as $list1) {
            $result['home_tranding_product_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }

    // Discounted
        $result['home_discounted_product'][$list->id] =
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_discounted'=>1])
            ->get();

        foreach ($result['home_discounted_product'][$list->id] as $list1) {
            $result['home_discounted_product_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }

// Home Banner
        $result['home_banner'] = DB::table('home_banners')
                ->where(['status'=>1])
                ->get();
        // echo '<pre>';
        // print_r($result);
        // die();

        return view('front.index', $result);
    }


// Product Details Page
    public function product(Request $request, $slug)
    {
// Product Details
        $result['product'] =
            DB::table('products')
            ->where(['status'=>1])
            ->where(['slug'=>$slug])
            ->get();
            // echo '<pre>';
            // print_r($result);
            // die();
        foreach ($result['product'] as $list1) {
            $result['product_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }

        foreach ($result['product'] as $list1) {
            $result['product_images'][$list1->id] =
                DB::table('product_images')
                ->where(['product_images.products_id'=>$list1->id])
                ->get();
        }


// Related Products
        $result['related_product'] =
            DB::table('products')
            ->where(['status'=>1])
            ->where(['category_id'=>$result['product'][0]->category_id])
            ->where('id','!=',$result['product'][0]->id)
            ->get();

        foreach ($result['related_product'] as $list1) {
            $result['related_product_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->get();
        }
        // prx($result);
        return view('front.product', $result);
    }


    public function add_to_cart(Request $request)
    {

         if ($request->session()->exists('FRONT_USER_LOGIN')){
            $uid = $request->sesson()->get('FRONT_USER_LOGIN');
            $user_type = "Reg";
        }else {
            // $uid = getUserTempId();
            if (session()->has('USER_TEMP_ID')) {

                $uid = $request->session()->get('USER_TEMP_ID');
            }else {
                $rand = rand(111111111,999999999);
                session()->put('USER_TEMP_ID',$rand);
                $uid = $rand;
            }
            $user_type = "Not-Reg";


        }
        $size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');
        // echo '<pre>';
        // print_r($size_id);
        // die();
        $result =DB::table('products_attr')
                ->SELECT('products_attr.id')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_id'=>$product_id])
                ->where(['sizes.size'=>$size_id])
                ->where(['colors.color'=>$color_id])
                ->get();
        // prx( $result[0]->id);
        $product_attr_id =  $result[0]->id;

        $check = $result['product'] =DB::table('cart')
                                        ->where(['user_id'=>$uid])
                                        ->where(['user_type'=>$user_type])
                                        ->where(['product_id'=>$product_id])
                                        ->where(['product_attr_id'=>$product_attr_id])
                                        ->get();
        // die();
        if (isset($check[0])) {
            $update_id = $check[0]->id;
            DB::table('cart')
                ->where(['id'=>$update_id])
                ->update(['qty'=>$pqty]);
            $msg = "Updated successfully.";

        }else {
            $id =DB::table('cart')->insertGetId([
                'user_id'=>$uid,
                'user_type'=>$user_type,
                'product_id'=>$product_id,
                'product_attr_id'=>$product_attr_id,
                'qty'=>$pqty,
                'added_on'=>date('Y-m-d h:i:s')
            ]);
            $msg = "Added successfully.";
        }
        return response()->json(['msg'=>$msg]);
        // echo $uid;
        // echo $user_type;

    }
}
