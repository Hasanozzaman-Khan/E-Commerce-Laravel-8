<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function index()
    {
        $result['data'] = Size::all();
        return view('admin.size', $result);
    }


    public function manage_size(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Size::where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($arr['0']);
            // die();
            $result['size'] = $arr['0']->size;
            $result['id'] = $arr['0']->id;
        }else {
            $result['size'] = '';
            $result['id'] = 0;
        }

        return view('admin.manage_size',$result);
    }


    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size' => 'required|unique:sizes,size,'.$request->post('id'),
        ]);


        if ($request->post('id') > 0) {
            $model = Size::find($request->post('id'));

            $msg = "Size updated successfully.";

        }else {
            $model = new Size();

            $msg = "Size inserted successfully.";

        }

        $model->size = $request->post('size');
        $model->status = 1;
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect('admin/size');
        // return $request->post();
    }


    public function delete(Request $request, $id)
    {
        $model = Size::find($id);
        $model->delete();

        $request->session()->flash('message','Size deleted successfully.');

        return redirect('admin/size');
    }


    public function status(Request $request, $status, $id)
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();

        $request->session()->flash('message','Size status updated successfully.');

        return redirect('admin/size');
    }

}
