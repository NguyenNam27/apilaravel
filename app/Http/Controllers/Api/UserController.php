<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use  Hash;

class UserController extends Controller
{
    public function index(){
        return 'all user';
    }
    public function detail(User $user){
        return 'user'.$user;
    }
    public function create(Request $request){
        $rule = [
            'name'=>'required|min:5',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ];
        $massage = [
            'name.required'=>'tên bắt buộc nhập',
            'name.min'=>'tên không được nho hơn:min',
            'email.required'=>'email bắt buộc phải nhập',
            'email.email'=>'email không đúng định dạng',
            'email.unique'=>'email đã tồn tại',
            'password.required'=>'mật khẩu bắt buộc phải nhập',
            'password.min'=>'mật khẩu không đc nhỏ hơn :min '
        ];

        $request->validate($rule,$massage);
        $user = New User();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = Hash::make($request->password);
        $user -> phone = $request->phone;
        $user->save();

        $response = [
            'status'=>'success',
            'data'=>$user
        ];
        return $response->json;
    }
    public function update_put(Request $request,$user){
        echo $request->method();
        return $request->all();
    }
    public function update_patch(Request $request,$user){
        echo $request->method();
        return $request->all();
    }
    public function delete($user){
        return $user;
    }
}
