<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <h3 class="h4 fw-semibold mb-4">Sales Transactions</h3>
        </div>

        <div class="row">
            {{-- Kolom 1 --}}
            <div class="col-12 col-xl-8">
                {{-- Kolom 1 Baris 1 --}}
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0"
                                    id="tableList" style="font-size: 12px">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Item Code</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Item Name</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Item Price</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Selling Unit</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Stock</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-center align-middle">{{ $item->item_code }}</td>
                                                <td class="text-center align-middle">{{ $item->item_name }}</td>
                                                <td class="text-center align-middle">{{ $item->item_price }}</td>
                                                <td class="text-center align-middle">{{ $item->selling_unit }}</td>
                                                <td class="text-center align-middle">{{ $item->stock }}</td>
                                                <td class="text-center align-middle">
                                                    <form action="#" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info btn-sm">
                                                            <i class="ti ti-plus" style="font-size: 10px;"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Kolom 1 Baris 2 --}}
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0"
                                    id="tableList1" style="font-size: 12px">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">No</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Item Code</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Item Name</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Stock</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Qty</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Selling Unit</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Item Price</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;">Total Item Price</th>
                                            <th class="text-center align-middle"
                                                style="padding-top: 5px; padding-bottom: 5px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($items as $item) --}}
                                        <tr>
                                            <td class="text-center align-middle">1</td>
                                            <td class="text-center align-middle">ITEM058</td>
                                            <td class="text-center align-middle">Mangga Jepang</td>
                                            <td class="text-center align-middle">50</td>
                                            <td class="text-center align-middle">3</td>
                                            <td class="text-center align-middle">/Satuan</td>
                                            <td class="text-center align-middle">15000</td>
                                            <td class="text-center align-middle">45000</td>
                                            <td class="text-center align-middle">
                                                <form action="#" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="ti ti-minus" style="font-size: 10px;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom 2 --}}
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <p>Halo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card-body {
                font-size: 12px;
            }

            .dataTables_filter input {
                height: 12px;
                padding: 5px;
                font-size: 12px;
                border-radius: .375rem;
                border: 1px solid #ced4da;
                background-color: #f8f9fa;
            }

            .dataTables_filter input:focus {
                border-color: #80bdff;
                outline: 0;
                box-shadow: 0 0 0 .25rem rgba(0, 123, 255, .25);
            }

            /* Menambahkan CSS untuk pagination */
            .dataTables_paginate {
                font-size: 12px;
                /* Mengatur ukuran font pagination */
            }

            .dataTables_paginate a {
                /* padding: 5px 10px; */
                margin: 0 2px;
                font-size: 12px;
                border-radius: 0.5rem;
            }
        </style>
    @endpush

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tableList').DataTable({
                    createdRow: function(row, data, dataIndex) {
                        $(row).find('td').css('padding', '5px');
                    },
                    scrollY: '100px',
                    scrollCollapse: false,
                    scrollX: false,
                    autoWidth: true,
                    columnDefs: [{
                        targets: -1,
                        orderable: false
                    }]
                });

                // Menunggu sedikit waktu sebelum menyesuaikan kolom
                setTimeout(function() {
                    table.columns.adjust().draw();
                }, 100); // Delay 10ms
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tableList1').DataTable({
                    createdRow: function(row, data, dataIndex) {
                        $(row).find('td').css('padding', '5px');
                    },
                    scrollY: '100px',
                    scrollCollapse: false,
                    scrollX: false,
                    autoWidth: true,
                    searching: false,
                    columnDefs: [{
                        targets: -1,
                        orderable: false
                    }]
                });

                // Menunggu sedikit waktu sebelum menyesuaikan kolom
                setTimeout(function() {
                    table.columns.adjust().draw();
                }, 100); // Delay 10ms
            });
        </script>
    @endpush
</x-app-layout>
