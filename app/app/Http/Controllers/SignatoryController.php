<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignatoryController extends Controller
{
    public function index()
    {
        return view('signatory.index');
    }
}
