<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();  
            return $next($request);
        });
    }
    public function adminDashboard(){
        //dd($this->user);
        if (is_null($this->user) ||  !$this->user->can('admin.dashboard')) {
            $message = 'You are not allowed to access this page !';
            abort(403);
        }
        return view('backend.dashboard.admin_dashboard');
    }
    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
