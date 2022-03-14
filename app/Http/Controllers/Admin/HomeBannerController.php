<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Storage;

class HomeBannerController extends Controller
{

    public function index()
    {
        $result['data'] = HomeBanner::all();
        return view('admin.home_banner', $result);
    }


    public function manage_home_banner(Request $request, $id='')
    {
        if ($id>0) {
            $arr = HomeBanner::where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($arr['0']);
            // die();
            $result['image'] = $arr['0']->image;
            $result['btn_text'] = $arr['0']->btn_text;
            $result['btn_link'] = $arr['0']->btn_link;
            $result['id'] = $arr['0']->id;

        }else {
            $result['image'] = '';
            $result['btn_text'] = '';
            $result['btn_link'] = '';
            $result['id'] = 0;

        }

        return view('admin.manage_home_banner',$result);
    }


    public function manage_home_banner_process(Request $request)
    {

        $request->validate([
            'image'=>'required|mimes:jpeg,jpg,png',
        ]);

        if ($request->post('id') > 0) {
            $model = HomeBanner::find($request->post('id'));

            $msg = "Home Banner updated successfully.";

        }else {
            $model = new HomeBanner();

            $msg = "Home Banner inserted successfully.";
        }

        if ($request->hasfile("image")) {

            if ($request->post('id') > 0) {
                $arrImage = DB::table('home_banners')->where(['id'=>$request->post('id')])->get();
                // echo '<pre>';
                // print_r($arrImage['0']->image);
                // die();
                if (Storage::exists('/public/media/banner/'.$arrImage['0']->image)) {
                    Storage::delete('/public/media/banner/'.$arrImage['0']->image);
                }
            }

            $image = $request->file("image");
            $ext = $image->extension();
            $image = time().'.'.$ext;
            $request->file("image")->storeAs('/public/media/banner', $image);
            $model->image = $image;
        }

        $model->btn_text = $request->post('btn_text');
        $model->btn_link = $request->post('btn_link');
        $model->status = 1;
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect('admin/home_banner');

    }


    public function delete(Request $request, $id)
    {
        $model = HomeBanner::find($id);

        if (Storage::exists('/public/media/banner/'.$model->image)) {
            Storage::delete('/public/media/banner/'.$model->image);
        }
        $model->delete();

        $request->session()->flash('message','Home Banner deleted successfully.');

        return redirect('admin/home_banner');
    }


    public function status(Request $request, $status, $id)
    {
        $model = HomeBanner::find($id);
        $model->status = $status;
        $model->save();

        $request->session()->flash('message','Home Banner status updated successfully.');

        return redirect('admin/home_banner');
    }

}
