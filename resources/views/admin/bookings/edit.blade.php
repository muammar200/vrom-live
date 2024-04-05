<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">←</a>
            {!! __('Booking &raquo; Sunting &raquo; #') . $booking->id . ' &middot; ' . $booking->name !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                            Ada kesalahan!
                        </div>
                        <div>
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form class="w-full" action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                {{-- <form class="w-full" action="/ammarupdate/{{ $booking->id }}"
                    method="POST"  --}}
                    @csrf
                    @method('put') 
                    <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                    <div class="w-full">
                        <label for="name"
                            class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Nama</label>
                        <input value="{{ old('name') ?? $booking->name }}" name="name"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="name" type="text">
                        <div class="mt-2 text-sm text-gray-500">
                            Nama booking. Contoh: Muammar
                        </div>
                    </div>
            </div>

            <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                <div class="w-full">
                    <label for="address"
                        class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Alamat</label>
                    <input value="{{ old('address') ?? $booking->address }}" name="address"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="address" type="text">
                    <div class="mt-2 text-sm text-gray-500">
                        Alamat booking. Contoh: Kampus 2 UIN Alauddin Makassar
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                <div class="w-full">
                    <label for="city"
                        class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Kota</label>
                    <input value="{{ old('city') ?? $booking->city }}" name="city"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="city" type="text">
                    <div class="mt-2 text-sm text-gray-500">
                        Kota booking. Contoh: Makassar
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                <div class="w-full">
                    <label for="zip"
                        class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Kode Pos</label>
                    <input value="{{ old('zip') ?? $booking->zip }}" name="zip"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="zip" type="text">
                    <div class="mt-2 text-sm text-gray-500">
                        Kode Pos booking. Contoh: 92123
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                <div class="w-full">
                    <label for="status"
                        class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Status
                        Booking</label>
                    <select name="status" id="status"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                        </option>
                        <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>Done</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>

                    <div class="mt-2 text-sm text-gray-500">
                        Status Booking. Contoh: Pending
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                <div class="w-full">
                    <label for="payment_status"
                        class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Status
                        Pembayaran</label>
                    <select name="payment_status" id="payment_status"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending
                        </option>
                        <option value="success" {{ $booking->payment_status == 'success' ? 'selected' : '' }}>Success
                        </option>
                        <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed
                        </option>
                        <option value="expired" {{ $booking->payment_status == 'expired' ? 'selected' : '' }}>Expired
                        </option>
                    </select>
                    <div class="mt-2 text-sm text-gray-500">
                        Status Pembayaran. Contoh: Pending
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap mx-3 mb-6">
                <div class="w-full px-3 text-right">
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-gray-500 rounded shadow-lg hover:bg-green-700">Simpan
                        Booking</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
