<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <h1 class="h1 fw-semibold mb-4">Sales Transactions</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0" id="tableList">
                                <thead class="table-success">
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Item Price</th>
                                        <th>Selling Unit</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->item_code }}</td>
                                            <td>{{ $item->item_name }}</td>
                                            <td>{{ $item->item_price }}</td>
                                            <td>{{ $item->selling_unit }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td class="d-flex gap-1">
                                                <form action="#" method="post">
                                                    @csrf

                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        <i class="ti ti-plus"></i>
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
