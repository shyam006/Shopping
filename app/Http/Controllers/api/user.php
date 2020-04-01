<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class user extends Controller
{
    public function register(Request $req)
    {
        $data['name'] = $req->name;
        $data['email'] = $req->email;
        $data['password'] = md5($req->password);
        $data['status'] = '1'; 
        $data['created_at'] = date('Y-m-d H:i:s'); 
        $result = DB::table('users')->insert($data);
        if($result)
        {
            $response['status'] = '1';
            $response['desc'] = 'Registration Successfull';
        }
        else
        {
            $response['status'] = '0';
            $response['desc'] = 'Registration Failed';
        }
        return json_encode($response);
    }
}
