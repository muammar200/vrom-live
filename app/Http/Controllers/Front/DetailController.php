<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function index($slug){
        $item = Item::with(['brand', 'type'])->where('slug', $slug)->firstOrFail();

        $similarItems = Item::where('brand_id', $item->brand_id)
        ->where('type_id', $item->type_id)
        // ->whereBetween('price', [$item->price - 10000000, $item->price + 10000000])
        ->where('star', '>=', $item->star - 0.5)
        ->where('star', '<=', $item->star + 0.5)
        ->where('id', '!=', $item->id)
        ->inRandomOrder()
        ->limit(4)
        ->get();

        if ($similarItems->isEmpty()) {
            $noSimilarItemsMessage = "No similar cars found.";
            return view('detail', compact('item', 'noSimilarItemsMessage'));
        }
        
        return view('detail', compact('item', 'similarItems'));
    }
}
