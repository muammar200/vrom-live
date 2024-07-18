<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Booking;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index($slug)
    {
        $item = Item::with(['type', 'brand'])->where('slug', $slug)->firstOrFail();
        return view('checkout', compact('item'));
    }

    public function store(CheckoutRequest $request, $slug)
    {
        // Format start_date and end_date from dd mm yy to timestamp
        $start_date = Carbon::createFromFormat('d m Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date);

        // Count the number of days between start_date and end_date
        $days = $start_date->diffInDays($end_date);

        // Get the item
        $item = Item::where('slug', $slug)->firstOrFail();

        // Calculate total price 
        $total_price = $days * $item->price;

        // Add 10% tax
        // $total_price = $total_price + ($total_price * 0.10);
        $total_price += ($total_price * 0.10);

        // create the booking
        $booking = $item->bookings()->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'total_price' => $total_price,
        ]);

        return redirect()->route('front.payment', $booking->id);

    }
}
