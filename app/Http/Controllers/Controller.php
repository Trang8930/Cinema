<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     public function dangnhap(Request $request)
    {
            $user=$request->username;
            $password=$request->pass;
        if(Auth::attempt(['name'=>$user,'password'=>$password])){
            return redirect('/');
        }else{
            return 'thất bại';
        }
    }
     public function getdangky()
    {
        return view('.login.dangky');
    }
    public function postdangky(Request $request)
    {
        $this->validate($request,[
            'pass'=>'required|min:3',
            'repass'=>'required|min:3|same:pass'
        ],[
            'repass.same'=>'Bạn chưa nhập lại mật khẩu'
        ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->pass);
        $user->level=0;
        $user->save();
        return redirect('/');

    }
}
