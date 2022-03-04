<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $result['data'] = Category::all();
        return view('admin.category', $result);
    }


    public function manage_category(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Category::where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($arr['0']);
            // die();
            $result['category_name'] = $arr['0']->category_name;
            $result['category_slug'] = $arr['0']->category_slug;
            $result['parent_category_id'] = $arr['0']->parent_category_id;
            $result['category_image'] = $arr['0']->category_image;
            $result['id'] = $arr['0']->id;

            $result['category'] = DB::table('categories')->where('id', '!=', $id)->get();
        }else {
            $result['category_name'] = '';
            $result['category_slug'] = '';
            $result['parent_category_id'] = '';
            $result['category_image'] = '';
            $result['id'] = 0;

            $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        }



        return view('admin.manage_category',$result);
    }


    public function manage_category_process(Request $request)
    {

        $request->validate([
            'category_name'=>'required',
            'category_image'=>'required|mimes:jpeg,jpg,png',
            'category_slug' => 'required|unique:categories,category_slug,'.$request->post('id'),
        ]);


        if ($request->post('id') > 0) {
            $model = Category::find($request->post('id'));

            $msg = "Category updated successfully.";

        }else {
            $model = new Category();

            $msg = "Category inserted successfully.";

        }

        if ($request->hasfile("category_image")) {
            // $rand = rand('111111111','999999999');
            $image = $request->file("category_image");
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $request->file("category_image")->storeAs('/public/media/category', $image_name);
            $model->category_image = $image_name;
        }

        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id = $request->post('parent_category_id');
        $model->status = 1;
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect('admin/category');
        // return $request->post();
    }


    public function delete(Request $request, $id)
    {
        $model = Category::find($id);
        $model->delete();

        $request->session()->flash('message','Category deleted successfully.');

        return redirect('admin/category');
    }


    public function status(Request $request, $status, $id)
    {
        $model = Category::find($id);
        $model->status = $status;
        $model->save();

        $request->session()->flash('message','Category status updated successfully.');

        return redirect('admin/category');
    }


}
