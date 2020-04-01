<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class Home extends Controller
{

    public function index(Request $req)
    {
        if($req->session()->has('adminData'))
        {
            return redirect('/Dashboard');
        }
        return view('login');
    }

    public function checkLogin(Request $req)
    {
        $check['email']    = $req->email;
        $check['password'] = md5($req->password);
        $result = DB::table('admin@users')->where($check)->get()->toArray();
        if(!empty($result))
        {
            $req->session()->put('adminData', $result);
            return redirect('/Dashboard');
        }
        else
        {
            $req->session()->flash('status', 'Invalid Email ID or Password..!');
            return redirect('/');
        }
    }

    public function logout(Request $req)
    {
        $req->session()->forget('adminData');
        $req->session()->flush();
        return redirect('/');
    }
}
