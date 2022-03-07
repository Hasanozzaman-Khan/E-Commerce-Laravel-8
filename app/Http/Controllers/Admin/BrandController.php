<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Storage;

class BrandController extends Controller
{

    public function index()
    {
        $result['data'] = Brand::all();
        return view('admin.brand', $result);
    }


    public function manage_brand(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Brand::where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($arr['0']);
            // die();
            $result['name'] = $arr['0']->name;
            $result['image'] = $arr['0']->image;
            $result['status'] = $arr['0']->status;
            $result['is_home'] = $arr['0']->is_home;
            $result['is_home_selected'] = '';
            if ($arr['0']->is_home == 1) {
                $result['is_home_selected'] = 'checked';
            }
            $result['id'] = $arr['0']->id;
        }else {
            $result['name'] = '';
            $result['image'] = '';
            $result['status'] = '';
            $result['is_home'] = '';
            $result['is_home_selected'] = '';
            $result['id'] = 0;
        }

        return view('admin.manage_brand',$result);
    }


    public function manage_brand_process(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:brands,name,'.$request->post('id'),
            'image'=> 'mimes:jpeg,jpg,png',
        ]);


        if ($request->post('id') > 0) {
            $model = Brand::find($request->post('id'));

            $msg = "Brand updated successfully.";

        }else {
            $model = new Brand();

            $msg = "Brand inserted successfully.";

        }

        if ($request->hasfile('image')) {

            if ($request->post('id') > 0) {
                $arrImage = DB::table('brands')->where(['id'=>$request->post('id')])->get();
                // echo '<pre>';
                // print_r($arrImage['0']->category_image);
                // die();
                if (Storage::exists('/public/media/brand/'.$arrImage['0']->image)) {
                    Storage::delete('/public/media/brand/'.$arrImage['0']->image);
                }
            }

            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/brand', $image_name);
            $model->image = $image_name;
        }

        $model->name = $request->post('name');
        $model->is_home = 0;
        if ($request->post('is_home')!==null) {
            $model->is_home = 1;
        }
        $model->status = 1;
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect('admin/brand');
        // return $request->post();
    }


    public function delete(Request $request, $id)
    {
        $model = Brand::find($id);
        $model->delete();

        $request->session()->flash('message','Brand deleted successfully.');

        return redirect('admin/brand');
    }


    public function status(Request $request, $status, $id)
    {
        $model = Brand::find($id);
        $model->status = $status;
        $model->save();

        $request->session()->flash('message','Brand status updated successfully.');

        return redirect('admin/brand');
    }

}
