<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function test()
    {
        return view('test');
    }

    public function todos()
    {
        return view('todos.base');
    }

    public function companies()
    {
        return view('companies.base');
    }

    public function orders()
    {
        return view('orders.base');
    }
}
