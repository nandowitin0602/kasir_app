<x-app-layout>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title fw-semibold mb-4">Transaction Report</h1>

                <form action="{{ route('transaction-report.index') }}" method="get" id="transaction-form">
                    <div class="row mb-2">
                        <x-input-label for="dateTimeAwal" :value="__('From')" class="col-sm-2 col-form-label text-nowrap" />
                        <div class="col-sm-4">
                            <x-text-input id="dateTimeAwal" name="dateTimeAwal" type="text"
                                class="form-control inputTag" :value="request('dateTimeAwal')" autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('dateTimeAwal')" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <x-input-label for="dateTimeAkhir" :value="__('To')"
                            class="col-sm-2 col-form-label text-nowrap" />
                        <div class="col-sm-4">
                            <x-text-input id="dateTimeAkhir" name="dateTimeAkhir" type="text"
                                class="form-control inputTag" :value="request('dateTimeAkhir')" autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('dateTimeAkhir')" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row mb-4">
                    <x-input-label for="totalPriceFilter" :value="__('Total Price')"
                        class="col-sm-2 col-form-label text-nowrap" />
                    <div class="col-sm-4">
                        <x-text-input id="totalPriceFilter" name="totalPriceFilter" type="text"
                            class="form-control inputTag" :value="$totalPrice" readonly />
                        <x-input-error class="mt-2" :messages="$errors->get('totalPriceFilter')" />
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" id="tableList">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center align-middle">Transaction ID</th>
                                <th class="text-center align-middle">Transaction Date</th>
                                <th class="text-center align-middle">Total Price</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="text-center align-middle">{{ $transaction->transaction_id }}</td>
                                    <td class="text-center align-middle">{{ $transaction->transaction_date }}</td>
                                    <td class="text-center align-middle">{{ $transaction->total_price }}</td>
                                    <td class="text-center align-middle">
                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('transaction-report.details', $transaction) }}"
                                            style="width: 60px;">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .dataTables_filter input {
                height: 35px;
                padding: 10px;
                font-size: 14px;
                border-radius: .375rem;
                border: 1px solid #ced4da;
                background-color: #f8f9fa;
            }

            .dataTables_filter input:focus {
                border-color: #80bdff;
                outline: 0;
                box-shadow: 0 0 0 .25rem rgba(0, 123, 255, .25);
            }

            .inputTag {
                height: 35px;
                width: 200px;
                padding: 5px;
                font-size: 14px;
                border-radius: .375rem;
                border: 1px solid #ced4da;
                background-color: #f8f9fa;
            }

            .ui-datepicker select {
                height: 25px;
                /* Sesuaikan dengan kebutuhan Anda */
                font-size: 12px;
                /* Opsional: Sesuaikan ukuran font */
                padding: 2px;
                /* Opsional: Sesuaikan padding */
            }
        </style>
    @endpush

    @push('scripts')
        {{-- Datatables --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        {{-- Datepicker --}}
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableList').DataTable({

                })
            });
        </script>

        <script>
            $(function() {
                $("#dateTimeAwal").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd'
                });
            });

            $(function() {
                $("#dateTimeAkhir").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd'
                });
            });
        </script>

        <script>
            // Menangani vaSlidasi tanggal saat form disubmit
            document.getElementById('transaction-form').addEventListener('submit', function(event) {
                var dateTimeAwal = document.getElementById('dateTimeAwal').value;
                var dateTimeAkhir = document.getElementById('dateTimeAkhir').value;

                // Pastikan kedua tanggal tidak kosong
                if (dateTimeAwal && dateTimeAkhir) {
                    // Mengubah format tanggal ke objek Date untuk perbandingan
                    var awal = new Date(dateTimeAwal);
                    var akhir = new Date(dateTimeAkhir);

                    // Jika dateTimeAwal lebih besar dari dateTimeAkhir, tampilkan alert dan hentikan submit
                    if (awal > akhir) {
                        alert('Tanggal mulai (From) tidak boleh lebih besar dari tanggal akhir (To).');
                        event.preventDefault(); // Mencegah form untuk submit
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
