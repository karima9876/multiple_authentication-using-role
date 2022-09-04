<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function teacherLoginForm(){
        return view('backend.teacher.teacher_login');
    }
    public function teacherLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Auth::guard('teacher')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/teacher/dashboard');
        }else{
            Session::flash('error-msg','Invalid Email or Password');
            return redirect()->back();

        }
    }
}
