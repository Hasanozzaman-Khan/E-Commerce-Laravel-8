<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $result['data'] = Product::all();
        return view('admin/product', $result);
    }


    public function manage_product(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Product::where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($arr['0']);
            // die();
            $result['category_id'] = $arr['0']->category_id;
            $result['name'] = $arr['0']->name;
            $result['image'] = $arr['0']->image;
            $result['slug'] = $arr['0']->slug;
            $result['brand'] = $arr['0']->brand;
            $result['model'] = $arr['0']->model;
            $result['short_desc'] = $arr['0']->short_desc;
            $result['desc'] = $arr['0']->desc;
            $result['keywords'] = $arr['0']->keywords;
            $result['technical_specification'] = $arr['0']->technical_specification;
            $result['uses'] = $arr['0']->uses;
            $result['warranty'] = $arr['0']->warranty;

            $result['lead_time'] = $arr['0']->lead_time;
            $result['tax_id'] = $arr['0']->tax_id;
            $result['is_promo'] = $arr['0']->is_promo;
            $result['is_featured'] = $arr['0']->is_featured;
            $result['is_discounted'] = $arr['0']->is_discounted;
            $result['is_tranding'] = $arr['0']->is_tranding;


            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;

            $result['productAttrArr'] = DB::table('products_attr')->where(['products_id' => $id])->get();

            $productImagesArr = DB::table('product_images')->where(['products_id' => $id])->get();
            if (!isset($productImagesArr[0])) {
                $result['productImagesArr'][0]['id'] = '';
                $result['productImagesArr'][0]['images'] = '';
            }else {
                $result['productImagesArr'] = $productImagesArr;
            }
            // echo '<pre>';
            // print_r($result['productAttrArr']);
            // die();
        }else {
            $result['category_id'] = '';
            $result['name'] = '';
            $result['image'] = '';
            $result['slug'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['keywords'] = '';
            $result['technical_specification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';

            $result['lead_time'] =  '';
            $result['tax_id'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_tranding'] = '';

            $result['status'] = '';
            $result['id'] = 0;

            $result['productAttrArr'][0]['id'] = '';
            $result['productAttrArr'][0]['products_id'] = '';
            $result['productAttrArr'][0]['sku'] = '';
            $result['productAttrArr'][0]['attr_image'] = '';
            $result['productAttrArr'][0]['mrp'] = '';
            $result['productAttrArr'][0]['price'] = '';
            $result['productAttrArr'][0]['qty'] = '';
            $result['productAttrArr'][0]['size_id'] = '';
            $result['productAttrArr'][0]['color_id'] = '';

            $result['productImagesArr'][0]['id'] = '';
            $result['productImagesArr'][0]['images'] = '';

            // echo '<pre>';
            // print_r($result['productImagesArr']);
            // die();
        }

        // echo '<pre>';
        // print_r($result['productImagesArr']);
        // die();

        $result['category'] = DB::table('categories')->where(['status' => 1])->get();

        $result['sizes'] = DB::table('sizes')->where(['status' => 1])->get();

        $result['brands'] = DB::table('brands')->where(['status' => 1])->get();

        $result['colors'] = DB::table('colors')->where(['status' => 1])->get();

        $result['taxes'] = DB::table('taxes')->where(['status' => 1])->get();

        return view('admin.manage_product',$result);
    }


    public function manage_product_process(Request $request)
    {
        // echo '<pre>';
        // print_r($request->post());
        // die();

        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png";
        }else {
            $image_validation = "required|mimes:jpeg,jpg,png";
        }

        $request->validate([
            'name'=>'required',
            'image'=>$image_validation,
            'slug' => 'required|unique:products,slug,'.$request->post('id'),
            'attr_image.*'=>'mimes:jpeg,jpg,png',
            'images.*'=>'mimes:jpeg,jpg,png',
        ]);


        $paidArr = $request->post('paid');
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('qty');
        $size_idArr = $request->post('size_id');
        $color_idArr = $request->post('color_id');

        foreach ($skuArr as $key => $val) {
            $check = DB::table('products_attr')
            ->where('sku','=',$skuArr[$key])
            ->where('id','!=',$paidArr[$key])
            ->get();

            if (isset($check[0])) {
                $request->session()->flash('sku_error',$skuArr[$key].' sku already used.');
                return redirect(request()->headers->get('referer'));
            }
        }

        if ($request->post('id') > 0) {
            $model = Product::find($request->post('id'));

            $msg = "Product updated successfully.";

        }else {
            $model = new Product();

            $msg = "Product inserted successfully.";
        }

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }

        $model->category_id = $request->post('category_id');
        $model->name = $request->post('name');
        $model->slug = $request->post('slug');
        $model->brand = $request->post('brand');
        $model->model = $request->post('model');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->technical_specification = $request->post('technical_specification');
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');

        $model->lead_time = $request->post('lead_time');
        $model->tax_id = $request->post('tax_id');
        $model->is_promo = $request->post('is_promo');
        $model->is_featured = $request->post('is_featured');
        $model->is_discounted = $request->post('is_discounted');
        $model->is_tranding = $request->post('is_tranding');

        $model->status = 1;
        $model->save();

        $pid = $model->id;
/* product Attributes Start*/

        foreach ($skuArr as $key => $val) {
            $productAttrArr['products_id'] = $pid;
            $productAttrArr['sku'] = $skuArr[$key];

            $productAttrArr['mrp'] = (int)$mrpArr[$key];
            $productAttrArr['price'] = (int)$priceArr[$key];
            $productAttrArr['qty'] = (int)$qtyArr[$key];

            if ($size_idArr[$key]=='') {
                $productAttrArr['size_id'] = 0;
            }else {
                $productAttrArr['size_id'] = $size_idArr[$key];
            }

            if ($color_idArr[$key]=='') {
                $productAttrArr['color_id'] = 0;
            }else {
                $productAttrArr['color_id'] = $color_idArr[$key];
            }

            if ($request->hasfile("attr_image.$key")) {
                $rand = rand('111111111','999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $attr_image_name = $rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media', $attr_image_name);
                $productAttrArr['attr_image'] = $attr_image_name;
            }
            // else {
            //     $productAttrArr['attr_image'] = '';
            // }

            if ($paidArr[$key] != '') {
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }else {
                DB::table('products_attr')->insert($productAttrArr);
            }

            // code...
        }

/* product Attributes end*/

/* product Images Start*/
        $piidArr = $request->post('piid');
        foreach ($piidArr as $key => $val) {
            $productImagesArr['products_id'] = $pid;

            if ($request->hasfile("images.$key")) {
                $rand = rand('111111111','999999999');
                $images = $request->file("images.$key");
                $ext = $images->extension();
                $image_name = $rand.'.'.$ext;
                $request->file("images.$key")->storeAs('/public/media', $image_name);
                $productImagesArr['images'] = $image_name;

                if ($piidArr[$key] != '') {
                    DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImagesArr);
                }else {
                    DB::table('product_images')->insert($productImagesArr);
                }
            }
            // else {
            //     $productImagesArr['images'] = '';
            // }


        }
/* product Images end*/

        $request->session()->flash('message',$msg);
        return redirect('admin/product');
        // return $request->post();
    }


    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        $model->delete();

        $request->session()->flash('message','Product deleted successfully.');

        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request, $paid, $pid)
    {
        DB::table('products_attr')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function product_images_delete(Request $request, $piid, $pid)
    {
        DB::table('product_images')->where(['id'=>$piid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }



    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();

        $request->session()->flash('message','Product status updated successfully.');

        return redirect('admin/product');
    }
}
