<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;

class AdminController extends Controller
{
    //de middleware controleert of de gebruiker admin is en voorkomt dat niet-admins deze routes kunnen gebruiken.
    public function __construct()
    {
        $this->middleware('admin');  
    }

    //laat adminpanel zien
    public function index()
    {
        return view('admin.dashboard');
    }
}
