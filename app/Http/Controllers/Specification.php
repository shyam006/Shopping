<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class Specification extends Controller
{
    public function index(Request $req)
    {
        $data['category'] = DB::table('category')->get();
        $data['specification'] = DB::table('category')
                            ->select('category.*', DB::raw("count(specification.category_id) as count"))
                            ->leftJoin('specification', 'category.category_id','specification.category_id')
                            ->groupby('category.category_id','specification.category_id')
                            ->get();
        return view('specification/specification',$data);
    }

    public function add_spec(Request $req)
    {
        $cate['category_id'] = $req->category;
        $cate['name'] = $req->specification;
        $cate['created_at'] = date('Y-m-d H:i:s');
        $result = DB::table('specification')->insert($cate);
        if($result)
        {
            $req->session()->flash('status', 'Specification Added Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t add the specification, Please try again..!');
        }
        return redirect('/Specification');
    }

    public function get_cate_spec(Request $req)
    {
        $category_id = base64_decode($req->id);
        $category = DB::table('category')->where('category_id',$category_id)->get();
        $category_name ='';
        foreach($category as $cate)
        {
            $category_name = $cate->name;
        }
        $result = DB::table('specification')
                ->select('specification.specification_id','specification.name','category.name as category_name')
                ->leftJoin('category','category.category_id','specification.category_id')    
                ->where('specification.category_id',$category_id)
                ->get();
        if (count($result)==0)
        {
            $str = 'No Specifiation list is added';
        }
        else
        {
            $str = '<table class="table table-hover">
                    <thead>
                    <tr><th>Specification</th></tr>
                    </thead><tbody>';
                foreach($result as $specification)
                {
                    $str .= '<tr>
                            <td><a href="/Edit_Specification/'.base64_encode($specification->specification_id).'">'.$specification->name.'</a></td>
                            </tr>';
                }
            $str .='</tbody></table>';
        }
        $data['category'] = $category_name;
        $data['specification'] = $str; 
        echo json_encode($data);
    }
    public function edit_cate_spec(Request $req)
    {
        $id = base64_decode($req->id);
        $data['category'] = DB::table('category')->get();
        $data['specification'] = DB::table('specification')->where('specification_id',$id)->get();
        return view('specification/editspecification',$data);
    }
    public function edited(Request $req)
    {
        $id = base64_decode($req->id);
        $data['category_id'] = $req->category;
        $data['name'] = $req->name;
        $data['modified_at'] = date('Y-m-d H:i:s');
        $result = DB::table('specification')->where('specification_id',$id)->update($data);
        if($result)
        {
            $req->session()->flash('status', 'Specification Updated Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t update the specification, Please try again..!');
        }
        return redirect('/Specification');
    }

    public function delete(Request $req)
    {
        $id = base64_decode($req->id);
        $result = DB::table('specification')->where('specification_id',$id)->delete();
        if($result)
        {
            $req->session()->flash('status', 'Specification Deleted Successfully');
        }
        else
        {
            $req->session()->flash('status', 'Can\'t delete the specification, Please try again..!');
        }
        return redirect('/Specification');
    }
}
