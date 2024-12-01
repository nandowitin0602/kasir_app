<x-app-layout>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title fw-semibold mb-4">Item List</h1>
                <div class="mb-4">
                    @if (session('success'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                </div>
                <a class="btn btn-info mb-4" href="{{ route('item.create') }}">
                    Add
                </a>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" id="tableList">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center align-middle">Item Code</th>
                                <th class="text-center align-middle">Item Name</th>
                                <th class="text-center align-middle">Item Price</th>
                                <th class="text-center align-middle">Selling Unit</th>
                                <th class="text-center align-middle">Stock</th>
                                <th class="text-center align-middle">Is Deleted</th>
                                <th class="text-center align-middle">Create At</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $item->item_code }}</td>
                                    <td class="text-center align-middle">{{ $item->item_name }}</td>
                                    <td class="text-center align-middle text-nowrap">Rp {{ number_format($item->item_price, 0, ',', '.') }}</td>
                                    <td class="text-center align-middle">{{ $item->selling_unit }}</td>
                                    <td class="text-center align-middle">{{ $item->stock }}</td>
                                    <td class="text-center align-middle">
                                        @if ($item->is_deleted == 'n')
                                            <div class="shadow-lg text-center bg-success rounded pt-1 pb-1 text-white btn btn-sm">Active</div>
                                        @else
                                            <div class="shadow-lg text-center bg-danger rounded pt-1 pb-1 text-white btn btn-sm">Non-Active
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">{{ $item->created_at }}</td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a class="btn btn-warning btn-sm" href="{{ route('item.edit', $item) }}"
                                                style="width: 60px;">
                                                Edit
                                            </a>
                                            <form action="{{ route('item.destroy', $item) }}" method="post"
                                                class="ml-2">
                                                @csrf
                                                @method('delete')

                                                @if ($item->is_deleted == 'n')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        style="width: 90px;"
                                                        onclick="return confirm('Are you sure you want to non-active this item?')">
                                                        Non-Active
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        style="width: 90px;">
                                                        Active
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
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
