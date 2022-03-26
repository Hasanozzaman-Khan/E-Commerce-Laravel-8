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
        // prx($result['product_attr'][$result['product'][0]->id]);
        return view('front.product', $result);
    }

}
