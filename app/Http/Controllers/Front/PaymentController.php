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

    // public function update(Request $request, $bookingId)
    // {
    //     // load booking data
    //     $booking = Booking::findOrFail($bookingId);

    //     // set payment method
    //     $booking->payment_method = $request->payment_method;

    //     // Handle mitrans payment method
    //     if ($request->payment_method == 'midtrans') {
    //         // Set your Merchant Server Key
    //         \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
    //         // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //         \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
    //         // Set sanitization on (default)
    //         \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
    //         // Set 3DS transaction for credit card to true
    //         \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');


    //         // Get USD to IDR rate from using Guzzle
    //         $client = new \GuzzleHttp\Client();
    //         $response = $client->request('GET', 'https://v6.exchangerate-api.com/v6/4d33148742370e9c0906fe35/latest/USD');
    //         $body = $response->getBody();
    //         // $rate = json_decode($body)->rates->IDR;
    //         $data = json_decode($body);
    //         // Assuming rates are nested within a property named "conversion_rates"
    //         $rate = (float) $data->conversion_rates->IDR;


    //         // convert to IDR
    //         $totalPrice = $booking->total_price * $rate;

    //         // Create Midtrans Params
    //         // Docs : https://docs.midtrans.com/reference/request-body-json-parameter
    //         $midtransParams = [
    //             'transaction_details' => [
    //                 'order_id' => "IndoRent-" . $booking->id,
    //                 'gross_amount' => (int) $totalPrice,
    //                 // 'gross_amount' => (float) $totalPrice,
    //             ],
    //             'customer_details' => [
    //                 'first_name' => $booking->customer_name,
    //                 'email' => $booking->customer_emai,
    //             ],
    //             'enabled_payments' => ['gopay', 'bank_transfer'],
    //             'callbacks' => [
    //                 'finish' => route('front.payment.success'),
    //                 'error' => route('front.payment.error'),
    //                 'unfinish' => route('front.payment.unfinish'),
    //                 'notification' => route('front.payment.notification'),
    //             ],
    //         ];

    //         // Get Snap Payment page URL
    //         $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

    //         // Save payment url to booking
    //         $booking->payment_url = $paymentUrl;

    //         // Save booking
    //         $booking->save();
    //         // $booking->update();

    //         // Redirect to payment url
    //         return redirect($paymentUrl);   
    //     }

    //     return redirect()->route('front.index');
    // }

    public function update(Request $request, $bookingId)
    {
        // Load booking data
        $booking = Booking::findOrFail($bookingId);

        // Set payment method
        $booking->payment_method = $request->payment_method;

        // Handle Midtrans payment method
        if ($request->payment_method == 'midtrans') {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

            // Set the total price in IDR
            $totalPrice = $booking->total_price;

            // Create Midtrans Params
            $midtransParams = [
                'transaction_details' => [
                    'order_id' => "IndoRent-" . $booking->id,
                    'gross_amount' => (int) $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $booking->customer_name,
                    'email' => $booking->customer_email,
                ],
                'enabled_payments' => ['gopay', 'bank_transfer'],
                'callbacks' => [
                    'finish' => route('front.payment.success'),
                    'error' => route('front.payment.error'),
                    'unfinish' => route('front.payment.unfinish'),
                    'notification' => route('front.payment.notification'),
                ],
            ];

            // Get Snap Payment page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // Save payment URL to booking
            $booking->payment_url = $paymentUrl;
            $booking->save();

            // Redirect to payment URL
            return redirect($paymentUrl);
        }

        return redirect()->route('front.index');
    }


    public function success(Request $request)
    {
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');

        // Find the booking by order_id
        $booking = Booking::where('id', explode('-', $orderId)[1])->firstOrFail();

        // Update booking status based on transaction status
        if ($transactionStatus == 'capture') {
            $booking->payment_status = 'success';
        } else if ($transactionStatus == 'settlement') {
            $booking->payment_status = 'success';
        } else if ($transactionStatus == 'pending') {
            $booking->payment_status = 'pending';
        } else if ($transactionStatus == 'deny') {
            $booking->payment_status = 'denied';
        } else if ($transactionStatus == 'expire') {
            $booking->payment_status = 'expired';
        } else if ($transactionStatus == 'cancel') {
            $booking->payment_status = 'canceled';
        }

        // Save the updated booking status
        $booking->save();

        return view('success', compact('booking'));
    }


    public function error(Request $request)
    {
        dd('error');
    }

    public function unfinish(Request $request)
    {
        dd('unfinish');
    }

    public function notification(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        // Handle the notification from Midtrans
        $notification = new \Midtrans\Notification();

        // Get the order ID
        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $fraudStatus = $notification->fraud_status;

        // Find the booking by order_id
        $booking = Booking::where('id', explode('-', $orderId)[1])->firstOrFail();

        // Update booking status based on transaction status
        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $booking->payment_status = 'challenge';
                } else {
                    $booking->payment_status = 'success';
                }
            }
        } else if ($transactionStatus == 'settlement') {
            $booking->payment_status = 'success';
        } else if ($transactionStatus == 'pending') {
            $booking->payment_status = 'pending';
        } else if ($transactionStatus == 'deny') {
            $booking->payment_status = 'denied';
        } else if ($transactionStatus == 'expire') {
            $booking->payment_status = 'expired';
        } else if ($transactionStatus == 'cancel') {
            $booking->payment_status = 'canceled';
        }

        // Save the updated booking status
        $booking->save();

        return response()->json(['status' => 'ok']);
    }
}
