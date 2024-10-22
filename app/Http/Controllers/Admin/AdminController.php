<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Middlewares\RoleMiddleware;



class AdminController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    // string $id
    public function show()
    {
       
       return view('admin.dashboard');
    }
    public function store(Request $request)
    {
        //
    }
}
