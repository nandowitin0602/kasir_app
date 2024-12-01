<x-app-layout>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title fw-semibold mb-4">Transaction Report Details (ID = {{ $transaction_id }})</h1>
                <a href="{{ route('transaction-report.index') }}" class="btn btn-info mb-4">Back</a>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" id="tableList">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center align-middle">Transaction Detail ID</th>
                                <th class="text-center align-middle">Item Name</th>
                                <th class="text-center align-middle">Item Price</th>
                                <th class="text-center align-middle">Quantity</th>
                                <th class="text-center align-middle">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction_details as $transaction_detail)
                                <tr>
                                    <td class="text-center align-middle">
                                        {{ $transaction_detail->transaction_detail_id }}</td>
                                    <td class="text-center align-middle">{{ $transaction_detail->item->item_name }}</td>
                                    <td class="text-center align-middle">Rp {{ number_format($transaction_detail->item->item_price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center align-middle">{{ $transaction_detail->quantity }}</td>
                                    <td class="text-center align-middle">Rp {{ number_format($transaction_detail->total_price, 0, ',', '.') }}</td>
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
        </style>
    @endpush

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableList').DataTable({

                })
            });
        </script>
    @endpush
</x-app-layout>
