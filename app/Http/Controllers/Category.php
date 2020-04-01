<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class Category extends Controller
{
    public function index(Request $req)
    {
        $data['category'] = DB::table('category')
                            ->select('category.*', DB::raw("count(subcategory.category_id) as count"))
                            ->leftJoin('subcategory', 'category.category_id','subcategory.category_id')
                            ->groupby('category.category_id','subcategory.category_id')
                            ->get();
        return view('category/category',['category'=>$data['category']]);
    }

    public function new(Request $req)
    {
        return view('category/addCategory');
    }

    public function add_cate(Request $req)
    {
        $cate['name'] = $req->category;
        $cate['status']=1;
        $cate['created_at'] = date('Y-m-d H:i:s');
        $result = DB::table('category')->insert($cate);
        if($result)
        {
            $req->session()->flash('status', 'Category Added Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t add the category, Please try again..!');
        }
        return redirect('/Category');
    }

    public function edit_cate(Request $req)
    {
        $id = base64_decode($req->id);
        $result = DB::table('category')->where('category_id',$id)->get();
        return view('Category/editCategory',['category'=> $result]);
    }

    public function edited(Request $req)
    {
        $id = base64_decode($req->id);
        $data['name'] = $req->name;
        $data['status'] = $req->status;
        $data['modified_at'] = date('Y-m-d H:i:s');
        $result = DB::table('category')->where('category_id',$id)->update($data);
        if($result)
        {
            $req->session()->flash('status', 'Category Updated Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t update the category, Please try again..!');
        }
        return redirect('/Category');
    }

    public function delete(Request $req)
    {
        $id = base64_decode($req->id);
        $subcategory = $req->subcategory;
        $specification = $req->specification;
        $sub_result = true;
        $spec_result = true;
        if($subcategory == 'subcategory')
        {
            $sub_result = DB::table('subcategory')->where('category_id',$id)->delete();
        }
        if($specification == 'specification')
        {
            $spec_result = DB::table('specification')->where('category_id',$id)->delete();
        }
        if(($sub_result) && ($spec_result))
        {
            $result = DB::table('category')->where('category_id',$id)->delete();
            if($result)
            {
                $req->session()->flash('status', 'Category Deleted Successfully');
            }
            else
            {
                $req->session()->flash('status', 'Can\'t delete the category, Please try again..!');
            }
        }
        else
        {
            $req->session()->flash('status', 'Can\'t delete the category, Please try again..!');
        }
        return redirect('/Category');
    }


    public function get_data(Request $res)
    {
        return 'got the api response';
    }
}
