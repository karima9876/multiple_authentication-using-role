<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TeacherDashboardController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('teacher')->user();  
            return $next($request);
        });   
    }
    public function teacherDashboard(){
        //dd($this->user);
        if (is_null($this->user) ||  !$this->user->can('teacher.dashboard')) {
            $message = 'You are not allowed to access this page !';
           // echo $message;
            abort(403);
        }
        return view('backend.dashboard.teacher_dashboard');
    }
    public function teacherLogout(){
        Auth::guard('teacher')->logout();
        return redirect('teacher/login');
    }
}
