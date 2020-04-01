<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SubCategory extends Controller
{
    public function index(Request $req)
    {
        $data['category'] = DB::table('category')->orderBy('category_id', 'desc')->get();
        $data['subcategory'] = DB::table('subcategory')
                                ->leftJoin('category','category.category_id','subcategory.category_id')
                                ->select('subcategory.*','category.name as category')
                                ->get();
        return view('subcategory/subcategory',['category'=>$data['category'],'subcategory'=>$data['subcategory']]);
    }

    public function new(Request $req)
    {
        return view('category/addCategory');
    }

    public function add_cate(Request $req)
    {
        $cate['category_id'] = $req->category;
        $cate['name'] = $req->subcategory;
        $cate['status']=1;
        $cate['created_at'] = date('Y-m-d H:i:s');
        $result = DB::table('subcategory')->insert($cate);
        if($result)
        {
            $req->session()->flash('status', 'Sub Category Added Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t add the sub category, Please try again..!');
        }
        return redirect('/SubCategory');
    }

    public function edit_cate(Request $req)
    {
        $id = base64_decode($req->id);
        $data['category'] = DB::table('category')->orderBy('category_id', 'desc')->get();
        $data['subcategory'] = DB::table('subcategory')->where('subcategory_id',$id)->get();
        return view('subcategory/editSubCategory',['subcategory'=> $data['subcategory'],'category'=>$data['category']]);
    }

    public function edited(Request $req)
    {
        $id = base64_decode($req->id);
        $data['category_id'] = $req->category;
        $data['name'] = $req->name;
        $data['status'] = $req->status;
        $data['modified_at'] = date('Y-m-d H:i:s');
        $result = DB::table('subcategory')->where('subcategory_id',$id)->update($data);
        if($result)
        {
            $req->session()->flash('status', 'Sub Category Updated Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t update the sub category, Please try again..!');
        }
        return redirect('/SubCategory');
    }

    public function delete(Request $req)
    {
        $id = base64_decode($req->id);
        $result = DB::table('subcategory')->where('subcategory_id',$id)->delete();
        if($result)
        {
            $req->session()->flash('status', 'Sub Category Deleted Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t delete the sub category, Please try again..!');
        }
        return redirect('/SubCategory');
    }
}
