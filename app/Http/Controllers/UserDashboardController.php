<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Script DataTables, AJAX
        // if (request()->ajax()) {
        //     $query = Booking::query();

        //     return DataTables::of($query)
        //         // ->addColumn('action', function ($type) {
        //         //     return '
        //         //     <a class="block px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" href="' . route('admin.types.edit', $type->id) . '">
        //         //     Sunting
        //         //     </a>
        //         //     <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.types.destroy', $type->id) . '" method="POST">
        //         // <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline">
        //         //     Hapus
        //         // </button>          
        //         //         ' . method_field('delete') . csrf_field() . '
        //         //     </form>';
        //         // })
        //         // ->rawColumns(['action'])
        //         ->make();
        // }

        if (request()->ajax()) {
            $query = Booking::with('item')
                ->where('user_id', Auth::id())
                ->select('bookings.*');

            return datatables()->eloquent($query)
                ->addIndexColumn() // Add index for numbering
                ->addColumn('thumbnail', function ($booking) {
                    return '<img src="' . $booking->item->thumbnail . '" alt="Thumbnail" width="50">';
                })
                ->addColumn('mobil', function ($booking) {
                    return $booking->item->name;
                })
                ->editColumn('start_date', function ($booking) {
                    return $booking->start_date->format('d M Y');
                })
                ->editColumn('end_date', function ($booking) {
                    return $booking->end_date->format('d M Y');
                })
                ->editColumn('total_price', function ($booking) {
                    return 'Rp ' . number_format($booking->total_price, 2, ',', '.');
                })
                ->addColumn('payment_url', function ($booking) {
                    if ($booking->payment_status === 'success') {
                        return '<button class="inline-block w-full px-4 py-2 text-white bg-gray-500 rounded">Telah Dibayar</button>';
                    }
                    return $booking->payment_url
                        ? '<a href="' . $booking->payment_url . '" target="_blank" class="inline-block w-full px-4 py-2 text-center text-white bg-blue-500 rounded  hover:bg-blue-700">Bayar Sekarang</a>'
                        : '<button onclick="javascript:void(0)" class="inline-block w-full px-4 py-2 text-white bg-red-500 rounded cursor-not-allowed">Expired</button>';
                })
                ->rawColumns(['thumbnail', 'payment_url'])
                ->toJson();
        }

        return view('user.dashboard');
    }

    public function transaction()
    {
        return view('user-transaction');
    }
}
