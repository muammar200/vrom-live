<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Booking') }}
      </h2>
    </x-slot>
  
    <x-slot name="script">
      <script>
        // Format untuk tanggal
        function formatDate(dateString) {
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', options);
        }

        // Format untuk mata uang
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }

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
              data: 'id',
              name: 'id',
              render: function(data, type, row, meta) {
                return meta.row + 1; // Mengubah ID menjadi nomor urut
              }
            },
            {
              data: 'user.name',
              name: 'user.name'
            },
            {
              data: 'item.brand.name',
              name: 'item.brand.name'
            },
            {
              data: 'item.name',
              name: 'item.name'
            },
            {
              data: 'start_date',
              name: 'start_date',
              render: function(data, type, row) {
                return formatDate(data);
              }
            },
            {
              data: 'end_date',
              name: 'end_date',
              render: function(data, type, row) {
                return formatDate(data);
              }
            },
            {
              data: 'status',
              name: 'status'
            },
            {
              data: 'payment_status',
              name: 'payment_status'
            },
            {
              data: 'total_price',
              name: 'total_price',
              render: function(data, type, row) {
                return formatCurrency(data);
              }
            },
            {
              data: 'action',
              name: 'action',
              orderable: false,
              searchable: false,
              width: '15%'
            },
          ],
        });
      </script>
    </x-slot>
  
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-10">
          <a href="{{ route('admin.items.create') }}"
             class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
            + Buat Booking
          </a>
        </div>
        <div class="overflow-hidden shadow sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <table id="dataTable">
              <thead>
                <tr>
                  <th style="max-width: 1%">No</th>
                  <th>User</th>
                  <th>Brand</th>
                  <th>Item</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Status Booking</th>
                  <th>Status Pembayaran</th>
                  <th>Total Dibayar</th>
                  <th style="max-width: 1%">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
