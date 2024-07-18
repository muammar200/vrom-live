<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with(['item.brand', 'item.type'])->findOrFail($bookingId);
        return view('payment', compact('booking'));
    }

    public function update(Request $request, $bookingId)
    {
        // load booking data
        $booking = Booking::findOrFail($bookingId);

        // set payment method
        $booking->payment_method = $request->payment_method;

        // Handle mitrans payment method
        if ($request->payment_method == 'midtrans') {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');


            // Get USD to IDR rate from using Guzzle
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://v6.exchangerate-api.com/v6/4d33148742370e9c0906fe35/latest/USD');
            $body = $response->getBody();
            // $rate = json_decode($body)->rates->IDR;
            $data = json_decode($body);
            // Assuming rates are nested within a property named "conversion_rates"
            $rate = (float) $data->conversion_rates->IDR;


            // convert to IDR
            $totalPrice = $booking->total_price * $rate;

            // Create Midtrans Params
            // Docs : https://docs.midtrans.com/reference/request-body-json-parameter
            $midtransParams = [
                'transaction_details' => [
                    'order_id' => "IndoRent-" . $booking->id,
                    'gross_amount' => (int) $totalPrice,
                    // 'gross_amount' => (float) $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $booking->customer_name,
                    'email' => $booking->customer_emai,
                ],
                'enabled_payments' => ['gopay', 'bank_transfer'],
            ];

            // Get Snap Payment page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // Save payment url to booking
            $booking->payment_url = $paymentUrl;

            // Save booking
            $booking->save();
            // $booking->update();

            // Redirect to payment url
            return redirect($paymentUrl);   
        }

        return redirect()->route('front.index');
    }

    public function success(Request $request)
    {
        return view('success');
    }
}
