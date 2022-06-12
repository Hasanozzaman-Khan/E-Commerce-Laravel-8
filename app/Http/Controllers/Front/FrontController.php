<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Mail;

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
// prx($result);
        return view('front.index', $result);
    }


// Product Category Page
    public function category(Request $request, $slug)
    {
        $sort = "";
        $sort_text = "";
        $filter_price_start = "";
        $filter_price_end = "";
        $color_filter = "";
        $colorFilterArr = [];

        if ($request->get('sort') !== null) {
            $sort = $request->get('sort');
        }
        // echo $sort;

        $query = DB::table('products');
        $query = $query->leftJoin('categories','categories.id','=','products.category_id');
        $query = $query->leftJoin('products_attr','products_attr.products_id','=','products.id');
        $query = $query->where(['products.status'=>1]);
        $query = $query->where(['categories.category_slug'=>$slug]);
        // $query = $query->select('products.id', 'products.category_id', 'products.name', 'products.image', 'products.slug');

        if ($sort == 'name') {
            $query = $query->orderBy('products.name', 'desc');
            $sort_text = "Product Name";
        }
        if ($sort == 'date') {
            $query = $query->orderBy('products.id', 'asc');
            $sort_text = "Date";
        }
        if ($sort == 'price_asc') {
            $query = $query->orderBy('products_attr.price', 'asc');
            $sort_text = "Price - ASC";
        }
        if ($sort == 'price_desc') {
            $query = $query->orderBy('products_attr.price', 'desc');
            $sort_text = "Price - DESC";
        }

        if ($request->get('filter_price_start') !== null && $request->get('filter_price_end') !== null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');
            if ($filter_price_start>0 && $filter_price_end>0) {
                $query = $query->whereBetween('products_attr.price',[$filter_price_start, $filter_price_end]);

            }
        }

        if ($request->get('color_filter') !== null) {
            $color_filter = $request->get('color_filter');
            $colorFilterArr = explode(":", $color_filter);
            $colorFilterArr = array_filter($colorFilterArr);
            // prx($colorFilterArr);
            $query = $query->where(['products_attr.color_id' => $request->get('color_filter')]);

        }

        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;
// prx($result);


        foreach ($result['product'] as $list1) {
            $query1 = DB::table('products_attr');
            $query1 = $query1->leftJoin('sizes','sizes.id','=','products_attr.size_id');
            $query1 = $query1->leftJoin('colors','colors.id','=','products_attr.color_id');
            $query1 = $query1->where(['products_attr.products_id'=>$list1->id]);

            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }

        $result['colors'] =
            DB::table('colors')
            ->where(['status'=>1])
            ->get();

        $result['categories_left'] = DB::table('categories')
                ->where(['status'=>1])
                ->get();

// prx($result['categories_left']);
        $result['slug'] = $slug;
        $result['sort'] = $sort;
        $result['sort_text'] = $sort_text;
        $result['filter_price_start'] = $filter_price_start;
        $result['filter_price_end'] = $filter_price_end;
        $result['color_filter'] = $color_filter;
        $result['colorFilterArr'] = $colorFilterArr;
        return view('front.category', $result);
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

         if ($request->session()->has('FRONT_USER_LOGIN')){
            $uid = $request->session()->get('FRONT_USER_ID');
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
        // echo '<pre>';
        // print_r($uid);
        // die();
        $size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');
        // echo '<pre>';
        // print_r($uid);
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

        $check = DB::table('cart')
                ->where(['user_id'=>$uid])
                ->where(['user_type'=>$user_type])
                ->where(['product_id'=>$product_id])
                ->where(['product_attr_id'=>$product_attr_id])
                ->get();
        // die();
        if (isset($check[0])) {
            $update_id = $check[0]->id;
            if ($pqty == 0) {
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->delete();
                $msg = "Deleted successfully.";
            }else {
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->update(['qty'=>$pqty]);
                $msg = "Updated successfully.";
            }


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

        $result = DB::table('cart')
                ->leftJoin('products','products.id','=','cart.product_id')
                ->leftJoin('products_attr','products_attr.id','=','cart.product_attr_id')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['user_id'=>$uid])
                ->where(['user_type'=>$user_type])
                ->select('cart.qty', 'products.name', 'products.image', 'sizes.size', 'colors.color', 'products_attr.price', 'products.slug', 'products.id as pid', 'products_attr.id as attr_id')
                ->get();

        return response()->json(['msg'=>$msg, 'data'=>$result, 'totalItem'=>count($result)]);
        // echo $uid;
        // echo $user_type;

    }


    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')){
           $uid = $request->session()->get('FRONT_USER_ID');
           $user_type = "Reg";
       }else {
           $uid = getUserTempId();
           $user_type = "Not-Reg";
       }

        $result['list'] = DB::table('cart')
                ->leftJoin('products','products.id','=','cart.product_id')
                ->leftJoin('products_attr','products_attr.id','=','cart.product_attr_id')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['user_id'=>$uid])
                ->where(['user_type'=>$user_type])
                ->select('cart.qty', 'products.name', 'products.image', 'sizes.size', 'colors.color', 'products_attr.price', 'products.slug', 'products.id as pid', 'products_attr.id as attr_id')
                ->get();
// prx($result);
// die();
        return view('front.cart', $result);
    }

// Search
    public function search(Request $request, $str)
    {

        $query = DB::table('products');
        $query = $query->leftJoin('categories','categories.id','=','products.category_id');
        $query = $query->leftJoin('products_attr','products_attr.products_id','=','products.id');
        $query = $query->where(['products.status'=>1]);
        $query = $query->where('products.name','like',"%$str%");
        $query = $query->orwhere('products.brand','like',"%$str%");
        $query = $query->orwhere('products.model','like',"%$str%");
        $query = $query->orwhere('products.short_desc','like',"%$str%");
        $query = $query->orwhere('products.desc','like',"%$str%");
        $query = $query->orwhere('products.keywords','like',"%$str%");
        $query = $query->orwhere('products.technical_specification','like',"%$str%");
        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;


        foreach ($result['product'] as $list1) {
            $query1 = DB::table('products_attr');
            $query1 = $query1->leftJoin('sizes','sizes.id','=','products_attr.size_id');
            $query1 = $query1->leftJoin('colors','colors.id','=','products_attr.color_id');
            $query1 = $query1->where(['products_attr.products_id'=>$list1->id]);

            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }


        // prx($result);

        return view('front.search', $result);

        // echo $str;
    }

// Registration
    public function registration(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')!=null) {
            return redirect('/');
        }

        $result = [];
        return view('front.registration', $result);
    }

    public function registration_process(Request $request)
    {
        $valid = Validator::make($request->all(),[
            "name"=>'required',
            "email"=>'required|email|unique:customers,email',
            "password"=>'required',
            "mobile"=>'required|numeric|digits:11',
        ]);

        if (!$valid->passes()) {
            return response()->json(['status'=>'error', 'error'=>$valid->errors()->toArray()]);
        }else {
            $rand_id = rand(111111111,999999999);
            $arr = [
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Crypt::encrypt($request->password),
                "mobile"=>$request->mobile,
                "status"=>1,
                "is_verify"=>0,
                "rand_id"=>$rand_id,
                "is_forgot_password"=>0,
                "created_at"=>date('Y-m-d h:i:s'),
                "updated_at"=>date('Y-m-d h:i:s')
            ];

            $query = DB::table('customers')->insert($arr);
            if ($query) {

                $data=['name'=>$request->name,'rand_id'=>$rand_id];
                $user['to']=$request->email;
                Mail::send('front/email_varification',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Email Id Verification');
                });

                return response()->json(['status'=>'success', 'msg'=>'Registration successfull.Please check your email for varification.']);
            }
        }
    }


    public function login_process(Request $request)
    {
        // prx($_POST);
        $result = DB::table('customers')
                ->where(['email'=>$request->str_login_email])
                ->get();

        if (isset($result[0])) {

            $db_pwd = Crypt::decrypt($result[0]->password);
            $status = $result[0]->status;
            $is_verify = $result[0]->is_verify;

            if ($is_verify == 0) {
                return response()->json(['status'=>'error', 'msg'=>'Please verify your account.']);
            }
            if ($status == 0) {
                return response()->json(['status'=>'error', 'msg'=>'Your account has been deactivated.']);
            }

            if ($db_pwd == $request->str_login_password) {
                if ($request->rememberme === null) {
                    setcookie('login_email', $request->str_login_email, 30);
                    setcookie('login_pwd', $request->str_login_password, 30);
                }else {
                    setcookie('login_email', $request->str_login_email, time() + 60*60*24*30);
                    setcookie('login_pwd', $request->str_login_password, time() + 60*60*24*30);
                }
                // die();
                $request->session()->put('FRONT_USER_LOGIN',true);
                $request->session()->put('FRONT_USER_ID',$result[0]->id);
                $request->session()->put('FRONT_USER_NAME',$result[0]->name);

                $status = "success";
                $msg = "successfully logged in.";

                $getUserTempId = getUserTempId();
                DB::table('cart')
                        ->where(['user_id'=>$getUserTempId, 'user_type'=>'Not-Reg'])
                        ->update(['user_id'=>$result[0]->id, 'user_type'=>'Reg']);

            }else {
                $status = "error";
                $msg = "Please enter valid password.";
            }

        }else {
            $status = "error";
            $msg = "Please enter valid email id.";
        }
// prx($result);
        return response()->json(['status'=>$status, 'msg'=>$msg]);

    }

    public function email_varification(Request $request, $id)
    {
        $result = DB::table('customers')
                ->where(['rand_id'=>$id])
                ->where(['is_verify'=>0])
                ->get();

        if (isset($result[0])) {
            DB::table('customers')
                    ->where(['id'=>$result[0]->id])
                    ->update(['is_verify'=>1, 'rand_id'=>'']);
            return view('front.varification');
        }else {
            return redirect('/');
        }
    }


    public function forgot_password(Request $request)
    {
        $result = DB::table('customers')
                ->where(['email'=>$request->str_forgot_email])
                ->get();

        $rand_id = rand(111111111,999999999);
        if (isset($result[0]))
        {
            // DB::table('customers')
            //     ->where(['email'=>$result[0]->id])
            //     ->update(['is_forgot_password'=>1, 'rand_id'=>$rand_id]);
            DB::table('customers')
                    ->where(['email'=>$request->str_forgot_email])
                    ->update(['is_forgot_password'=>1, 'rand_id'=>$rand_id]);

            $data=['name'=>$result[0]->name,'rand_id'=>$rand_id];
            $user['to']=$request->str_forgot_email;
            Mail::send('front/forgot_email',$data,function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Forgot password');
            });
            return response()->json(['status'=>'success', 'msg'=>'please check your email to change password.']);
        }else {
            return response()->json(['status'=>'error', 'msg'=>'Email id not registered.']);
        }

    }


    public function forgot_password_change(Request $request, $id)
    {
        $result = DB::table('customers')
                ->where(['rand_id'=>$id])
                ->where(['is_forgot_password'=>1])
                ->get();

        if (isset($result[0])) {
            $request->session()->put('FORGOT_PASSWORD_USER_ID',$result[0]->id);
            return view('front.forgot_password_change');
        }else {
            return redirect('/');
        }
    }

    public function forgot_password_change_process(Request $request)
    {

        // DB::table('customers')
        //     ->where(['id'=>$request->session()->get('FORGOT_PASSWORD_USER_ID')])
        //     ->update(
        //         [
        //             'is_forgot_password'=>0,
        //             'password'=>Crypt::encrypt($request->password),
        //             'rand_id'=>''
        //         ]
        //     );
        DB::table('customers')
                ->where(['id'=>$request->session()->get('FORGOT_PASSWORD_USER_ID')])
                ->update(['is_forgot_password'=>0, 'rand_id'=>'', 'password'=>Crypt::encrypt($request->password)]);
        // prx($request->session()->get('FORGOT_PASSWORD_USER_ID'));
        $request->session()->forget('FORGOT_PASSWORD_USER_ID');
        return response()->json(['status'=>'success', 'msg'=>'Password changed.']);
    }


// Checkout
    public function checkout(Request $request)
    {
        $result['cart_data'] = getAddToCartTotalItem();
        // prx($getAddToCartTotalItem);
        if (isset($result['cart_data'][0])) {

            if ($request->session()->has('FRONT_USER_LOGIN')){
               $uid = $request->session()->get('FRONT_USER_ID');

               $customer_info = DB::table('customers')
                       ->where(['id'=>$uid])
                       ->get();
                $result['customers']['name'] = $customer_info[0]->name;
                $result['customers']['email'] = $customer_info[0]->email;
                $result['customers']['mobile'] = $customer_info[0]->mobile;
                $result['customers']['address'] = $customer_info[0]->address;
                $result['customers']['city'] = $customer_info[0]->city;
                $result['customers']['state'] = $customer_info[0]->state;
                $result['customers']['zip'] = $customer_info[0]->zip;
                // prx($customer_info);
           }else {
               $result['customers']['name']    = '';
               $result['customers']['email']   = '';
               $result['customers']['mobile']  = '';
               $result['customers']['address'] = '';
               $result['customers']['city']    = '';
               $result['customers']['state']   = '';
               $result['customers']['zip']     = '';
           }

            return view('front.checkout', $result);
        }else {
            return redirect('/');
        }
    }



    public function apply_coupon_code(Request $request)
    {
        $arr = apply_coupon_code($request->coupon_code);
        $arr = json_decode($arr);
        // prx($arr->status);
        return response()->json(['status'=>$arr->status, 'msg'=>$arr->msg, 'totalPrice'=>$arr->totalPrice]);
    }


    public function remove_coupon_code(Request $request)
    {
        $result = DB::table('coupons')
                ->where(['code'=>$request->coupon_code])
                ->get();

        $getAddToCartTotalItem = getAddToCartTotalItem();
        $totalPrice = 0;
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);
        }


        return response()->json(['status'=>'success', 'msg'=>'Coupon code removed.', 'totalPrice'=>$totalPrice]);

    }



    public function place_order(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')){
            $coupon_value = 0;
            if ($request->coupon_code != '') {
                $arr = apply_coupon_code($request->coupon_code);
                $arr = json_decode($arr);

                if ($arr->status == 'success') {
                    $coupon_value = $arr->coupon_code_value;
                }else {
                    return response()->json(['status'=>$arr->status, 'msg'=>$arr->msg]);
                }
            }


           $uid = $request->session()->get('FRONT_USER_ID');

           $getAddToCartTotalItem = getAddToCartTotalItem();


           $totalPrice = 0;
           foreach ($getAddToCartTotalItem as $list) {
               $totalPrice = $totalPrice + ($list->qty * $list->price);
           }

           $arr = [
               "customers_id"=>$uid,
               "name"=>$request->name,
               "email"=>$request->email,
               "mobile"=>$request->mobile,
               "address"=>$request->address,
               "city"=>$request->city,
               "state"=>$request->state,
               "pincode"=>$request->zip,
               "coupon_code"=>$request->coupon_code,
               "coupon_value"=>$coupon_value,
               "order_status"=> 1,
               "payment_type"=>$request->payment_type,
               "payment_status" => "Pending",
               "total_amt"=>$totalPrice,
               "added_on"=>date('Y-m-d h:i:s')
           ];

           $order_id = DB::table('orders')->insertGetId($arr);

           if ($order_id > 0) {
               foreach ($getAddToCartTotalItem as $list) {
                   $productDetailArr['orders_id']=$order_id;
                   $productDetailArr['product_id']=$list->pid;
                   $productDetailArr['products_attr_id']=$list->attr_id;
                   $productDetailArr['price']=$list->price;
                   $productDetailArr['qty']=$list->qty;

                   // prx($productDetailArr);
                   DB::table('orders_details')->insert($productDetailArr);
               }

               DB::table('cart')->where(['user_id'=>$uid,'user_type'=>'Reg'])->delete();
               $request->session()->put('ORDER_ID',$order_id);

               $status = 'success';
               $msg = 'Order placed.';
           }else {
               $status = 'false';
               $msg = 'Please try after sometime.';
           }

       }else {
           $status = 'false';
           $msg = 'Please login to place order.';
       }
       return response()->json(['status'=>$status, 'msg'=>$msg]);
    }




    public function order_placed(Request $request)
    {

        if ($request->session()->has('ORDER_ID')){
            return view('front.order_placed');
        }else {
            return redirect('/');
        }
    }




}
