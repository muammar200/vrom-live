<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">←</a>
            {!! __('Item &raquo; Buat') !!}
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
                <form class="w-full" action="{{ route('admin.items.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                        <div class="w-full">
                            <label for="name"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Nama*</label>
                            <input value="{{ old('name') }}" name="name"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="name" type="text" placeholder="Nama" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Nama items. Contoh: Item 1, Item 2, Item 3, dsb. Wajib diisi. Maksimal 255 karakter.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                        <div class="w-full">
                            <label for="brand_id"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Brand*</label>
                            <select name="brand_id" id="brand_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                required>
                                <option value="">Pilih Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}\>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Brand item. Contoh : Porsche. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                        <div class="w-full">
                            <label for="type_id"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Type*</label>
                            <select name="type_id" id="type_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                required>
                                <option value="">Pilih type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type_id') == $type->id ? 'selected' : '' }}\>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Type item. Contoh : Electric Car. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                        <div class="w-full">
                            <label for="features"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Fitur</label>
                            <input value="{{ old('features') }}" name="features"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="features" type="text" placeholder="Fitur">
                            <div class="mt-2 text-sm text-gray-500">
                                Fitur items Contoh: Fitur 1, Fitur 2, Fitur 3, dsb. Dipisahkan dengan koma (,) Opsional
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mx-3 mt-4 mb-6">
                        <div class="w-full">
                            <label for="photos"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Foto</label>
                            <input value="{{ old('photos') }}" name="photos[]"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="photos" type="file" accept="image/png, image/jpeg, image/jpg, image/webp"
                                multiple>
                            <div class="mt-2 text-sm text-gray-500">
                                Foto item. Lebih dari satu foto dapat diupload. Opsional.
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 px-3 mx-3 mt-4 mb-5">

                        <div class="w-full">
                            <label for="price"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Harga</label>
                            <input value="{{ old('price') }}" name="price"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="price" type="number" placeholder="Harga" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Harga item. Angka. Contoh : 1500000. Wajib diisi.
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="rating"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Rating</label>
                            <input value="{{ old('star') }}" name="star"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="rating" type="number" step=".01" placeholder="Rating" min="0" max="5">
                            <div class="mt-2 text-sm text-gray-500">
                                Rating item. Angka. Contoh: 5. Opsional
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="review"
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Review</label>
                            <input value="{{ old('review') }}" name="review"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="review" type="number" placeholder="Review">
                            <div class="mt-2 text-sm text-gray-500">
                                Review item. Angka. Opsional.
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-gray-500 rounded shadow-lg hover:bg-green-700">Simpan
                                Item</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
