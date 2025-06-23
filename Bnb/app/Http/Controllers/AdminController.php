<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');  // Zorgt dat admin middleware altijd actief is
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
