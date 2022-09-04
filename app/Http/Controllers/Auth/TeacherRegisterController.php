<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Auth;
class TeacherRegisterController extends Controller
{
    public function teacherRegisterForm(){
        return view('backend.teacher.teacher_register');
    }
    public function teacherRegister(Request $request){
        //dd($request->all());
        $request->validate([
            // 'name'=>'required',
            // 'email'=>'required',
            // 'password'=>'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = teacher::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $data->assignRole('2');
        if(Auth::guard('teacher')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/teacher/dashboard');
        }else{
            Session::flash('error-msg','Invalid Email or Password');
            return redirect()->back();

        }
    }  
}
