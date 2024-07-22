<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index(){
        // $popularItems = Item::with(['brand', 'type'])
        // // ->orderBy('review', 'desc')
        // // ->orderBy('star', 'desc')
        // ->take(4)
        // ->get();

        // $popularItemIds = $popularItems->pluck('id')->toArray();

        $otherItems = Item::with(['brand', 'type'])
            // ->whereNotIn('id', $popularItemIds)
            // ->orderBy('review', 'desc')
            // ->orderBy('star', 'desc')
            ->get();

        return view('catalog', compact('otherItems'));
    }
}
