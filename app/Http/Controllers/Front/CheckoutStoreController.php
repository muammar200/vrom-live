<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutStoreController extends Controller
{
    public function store(Request $request, $slug)
    {
        return $request->all();
    }
}

