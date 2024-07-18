<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $bestItem = Item::with(['brand', 'type'])
            ->orderBy('review', 'desc')
            ->orderBy('star', 'desc')
            ->first();

        $popularItems = Item::with(['brand', 'type'])
        ->where('id', '!=', $bestItem->id)
        ->orderBy('review', 'desc')
        ->orderBy('star', 'desc')
        ->take(4)
        ->get();
        
        return view('landing', compact('popularItems', 'bestItem'));
    }
}
