<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class Product extends Controller
{
    public function index(Request $req)
    {
        $data['category'] = DB::table('category')
                            ->select('category.*', DB::raw("count(subcategory.category_id) as count"))
                            ->leftJoin('subcategory', 'category.category_id','subcategory.category_id')
                            ->groupby('category.category_id','subcategory.category_id')
                            ->get();
        $data['products'] = DB::table('products')
                            ->select('products.*','subcategory.name as subcategory','category.name as category')
                            ->leftJoin('category', 'category.category_id','products.category')
                            ->leftJoin('subcategory', 'subcategory.subcategory_id','products.subcategory')
                            ->get();
        return view('product/product',$data);
    }

    public function new(Request $req)
    {
        $data['category'] = DB::table('category')->get();
        return view('product/addProduct',$data);
    }

    public function get_subcate(Request $req)
    {
        $cate_id = $req->id;
        $datasub = DB::table('subcategory')->where('category_id',$cate_id)->get();
        $dataspec = DB::table('specification')->where('category_id',$cate_id)->get();
        $str='<option value="">Please Select Sub Category</option>';
        $str1='';
        foreach($datasub as $subcate)
        {
            $str .='<option value="'.$subcate->subcategory_id.'">'.$subcate->name.'</option>';
        }
        $feild_names = array();
        foreach($dataspec as $spec)
        {
            $str1 .='<div class="fieldgroup">
                        <input type="text" name="'.$spec->specification_id.'" class="required" placeholder="'.$spec->name.'" />
                    </div>';
            array_push($feild_names,$spec->specification_id);
        }
        $str1 .='<input type="hidden" name="feild_name" value="'.json_encode($feild_names).'">';
        $data['subcategory'] = $str;
        $data['specification'] = $str1;
        echo json_encode($data);
    }

    public function add(Request $req)
    {
        $product_details['category'] = $req->category;
        $product_details['subcategory'] = $req->subcategory;
        $product_details['name'] = $req->name;
        $product_details['price'] = $req->price;
        $product_details['description'] = $req->description==''?'Basic Description':$req->description;
        $product_details['status'] = 1;
        $product_details['created_at'] = date('Y-m-d H:i:s');
        $result = DB::table('products')->insertGetId($product_details);
        if($result!='')
        {
            $feilds = json_decode($req->feild_name);
            $specification_details = array(); 
            foreach($feilds as $spec)
            {
                $feild_name = $spec;
                $data['specification_id'] = $feild_name;
                $data['value'] = $req->$feild_name;
                $data['product_id'] = $result;
                DB::table('product_specification')->insert($data);
            }
        }
        $primary_pic = $req->file('primarypic');
        $name = $primary_pic->getClientOriginalName();
        $target_path = public_path('/assets/uploads/products/'.$result.'/');
        $primary_pic->move($target_path, $name);
        $update_details['primary_pic'] = $name;

        $pics = $req->file('pic');
        foreach($pics as $pic)
        {
            $name = $pic->getClientOriginalName();
            $target_path = public_path('/assets/uploads/products/'.$result.'/');
            $pic->move($target_path, $name);
            $pic_name[] = $name;    
        }
        $update_details['pics'] = json_encode($pic_name);
        $final_result = DB::table('products')->where('product_id',$result)->update($update_details);
        if($final_result)
        {
            $req->session()->flash('status', 'Product Added Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t Add the product, Please try again..!');
        }
        return redirect('/Product');
    }
}
