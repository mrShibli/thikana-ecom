<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductControler extends Controller
{
    public function index() : View {
        return view('clientside.singelProduct');
    }
}
