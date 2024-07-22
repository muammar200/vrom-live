<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Brand') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
                },
                columns: [
                    {
                        data: null,
                        name: 'nomor',
                        orderable: false,
                        searchable: false,
                        className: 'nomor-kolom',
                        width: '5%',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'nama-kolom',
                        width: '30%' // Atur lebar kolom nama
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'aksi-kolom',
                        width: '1%'
                    },
                ],
            });
        </script>
    </x-slot>

    <style>
        .nomor-kolom {
            width: 5%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nama-kolom {
            width: 30%; /* Tentukan lebar yang lebih kecil untuk kolom Nama */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left; /* Pastikan isi kolom disejajarkan ke kiri */
        }

        .aksi-kolom {
            width: 1%;
            white-space: nowrap;
        }

        #dataTable thead th {
            text-align: left; /* Pastikan header kolom disejajarkan ke kiri */
        }
    </style>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin.brands.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Buat Type
                </a>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
