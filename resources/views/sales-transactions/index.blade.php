<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <h3 class="h4 fw-semibold mb-4">Sales Transactions</h3>
        </div>

        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                                                    <button type="button" class="btn btn-info btn-sm buttonPlus">
                                                        <i class="ti ti-plus" style="font-size: 9px;"></i>
                                                    </button>
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

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom 2 --}}
            <div class="col-12 col-xl-4 ps-4">
                {{-- Kolom 2 Baris 1 --}}
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-between">
                                <p class="mb-0">Total Price</p>
                                <h5 class="h5 fw-bold mb-0 totalHarga">Rp 0,00</h5>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom 2 Baris 2 --}}
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-between mb-3">
                                <h7 class="h7 fw-bold mb-0" id="realtime-date"></h7>
                                <h7 class="h7 fw-bold mb-0" id="realtime-clock"></h7>
                            </div>
                            <div class="d-flex justify-between mb-3">
                                <p class="mb-0">Kasir</p>
                                <h7 class="h7 fw-bold mb-0">{{ Auth::user()->name }}</h7>
                            </div>
                            <hr>
                            <br>
                            <div class="d-flex justify-between">
                                <button type="button" class="btn btn-danger mb-0 buttonReset">Reset</button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary buttonPay">
                                    Pay
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <form action="{{ route('sales-transactions.store') }}" method="post">
                                            @csrf

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Transaction
                                                        Details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-3">
                                                                            <p class="mb-0">Date</p>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <h7
                                                                                class="h7 fw-bold mb-0 modal-realtime-date">
                                                                            </h7>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-3">
                                                                            <p class="mb-0">Kasir</p>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <h7 class="h7 fw-bold mb-0">
                                                                                {{ Auth::user()->name }}</h7>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table text-start align-middle table-bordered table-hover mb-0"
                                                                                id="tableList2"
                                                                                style="font-size: 12px">
                                                                                <thead class="table-success">
                                                                                    <tr>
                                                                                        <th class="text-center align-middle"
                                                                                            style="padding-top: 5px; padding-bottom: 5px;">
                                                                                            No</th>
                                                                                        <th class="text-center align-middle"
                                                                                            style="padding-top: 5px; padding-bottom: 5px;">
                                                                                            Item Code</th>
                                                                                        <th class="text-center align-middle"
                                                                                            style="padding-top: 5px; padding-bottom: 5px;">
                                                                                            Item Name</th>
                                                                                        <th class="text-center align-middle"
                                                                                            style="padding-top: 5px; padding-bottom: 5px;">
                                                                                            Qty</th>
                                                                                        <th class="text-center align-middle"
                                                                                            style="padding-top: 5px; padding-bottom: 5px;">
                                                                                            Selling Unit</th>
                                                                                        <th class="text-center align-middle"
                                                                                            style="padding-top: 5px; padding-bottom: 5px;">
                                                                                            Item Price</th>
                                                                                        <th class="text-center align-middle"
                                                                                            style="padding-top: 5px; padding-bottom: 5px;">
                                                                                            Total Item Price</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-8 text-end">
                                                                            <p class="mb-0">Total Price of All : </p>
                                                                        </div>
                                                                        <div class="col-4 text-start ps-5">
                                                                            <h5
                                                                                class="h5 fw-bold mb-0 totalHargaModal">
                                                                            </h5>
                                                                            <input type="hidden" name="total_price"
                                                                                value="0"
                                                                                class="totalHargaModalInput">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-8 text-end">
                                                                            <p class="mb-0">The amount received :</p>
                                                                        </div>
                                                                        <div class="col-4 text-start ps-5">
                                                                            <input type="text"
                                                                                class="inputTag autoNumInputModal"
                                                                                id="uangDiterima" style="width: 150px"
                                                                                required autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-8 text-end">
                                                                            <p class="mb-0">The amount returned :</p>
                                                                        </div>
                                                                        <div class="col-4 text-start ps-5">
                                                                            <input type="text" class="inputTag"
                                                                                readonly id="uangKembali"
                                                                                style="width: 150px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        id="submitBtn">Confirmation</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('styles')
            <style>
                .inputTag {
                    height: 25px;
                    width: 60px;
                    padding: 5px;
                    font-size: 12px;
                    border-radius: .375rem;
                    border: 1px solid #ced4da;
                    background-color: #f8f9fa;
                }

                .card {
                    margin-bottom: 10px;
                }

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
            {{-- Script Datatable --}}
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

            {{-- Script Autonumeric --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.10.5/autoNumeric.min.js"
                integrity="sha512-EGJ6YGRXzV3b1ouNsqiw4bI8wxwd+/ZBN+cjxbm6q1vh3i3H19AJtHVaICXry109EVn4pLBGAwaVJLQhcazS2w=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.10.5/autoNumeric.js"
                integrity="sha512-XrQSAJkenc7fNUusjIG2X0/BQvde3lbKScw81XDgLlFRYGG9swBhtu7aiD+9V9VRWKGaPvn9sD5PegKcbogV8A=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            {{-- ============================================================ --}}

            {{-- Datatable untuk table 1 --}}
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

            {{-- Datatable untuk table 2 --}}
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

            {{-- Datatable untuk table 3 --}}
            <script type="text/javascript">
                $(document).ready(function() {
                    var table = $('#tableList2').DataTable({
                        createdRow: function(row, data, dataIndex) {
                            $(row).find('td').css('padding', '5px');
                        },
                        scrollY: '200px',
                        scrollCollapse: true,
                        scrollX: false,
                        autoWidth: true,
                        searching: false,
                        columnDefs: [{
                            targets: -1,
                            orderable: false
                        }]
                    });

                    // Menyesuaikan kolom setelah modal dibuka
                    $('#staticBackdrop').on('shown.bs.modal', function() {
                        table.columns.adjust().draw(); // Memperbarui kolom
                    });

                    // Menunggu sedikit waktu sebelum menyesuaikan kolom
                    setTimeout(function() {
                        table.columns.adjust().draw();
                    }, 100); // Delay 10ms
                });
            </script>

            {{-- Datetime Js (Realtime) --}}
            <script>
                function updateClock() {
                    const now = new Date();

                    // Opsi untuk format waktu
                    const options = {
                        weekday: undefined, // Bisa diubah menjadi 'long' jika ingin hari
                        year: 'numeric',
                        month: 'long', // 'long' untuk Februari, 'short' untuk Feb, 'numeric' untuk angka
                        day: 'numeric'
                    };

                    // Format waktu
                    const formattedDate = now.toLocaleDateString('id-ID', options);
                    const formattedTime = now.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    });

                    document.getElementById("realtime-date").textContent = formattedDate;
                    document.getElementById("realtime-clock").textContent = formattedTime;

                    // Update elemen di dalam modal
                    const modalDateElements = document.querySelectorAll(".modal-realtime-date");
                    modalDateElements.forEach((element) => {
                        element.textContent = formattedDate;
                    });
                }

                updateClock();
                setInterval(updateClock, 1000);
            </script>

            {{-- Js di luar Modal Box --}}
            <script>
                // Event handler untuk tombol tambah ke tabel kedua
                $(".buttonPlus").click(function() {
                    // Cari baris tempat tombol diklik
                    var row = $(this).closest("tr");

                    // Ambil data dari baris yang diklik
                    var itemCode = row.find("td").eq(0).text();
                    var itemName = row.find("td").eq(1).text();
                    var itemPrice = parseFloat(row.find("td").eq(2).text());
                    var sellingUnit = row.find("td").eq(3).text();
                    var stock = parseFloat(row.find("td").eq(4).text());

                    // Cek apakah item_code sudah ada di tabel kedua
                    var exists = false;
                    $("#tableList1 tbody tr").each(function() {
                        if ($(this).find("td").eq(0).text() === itemCode) {
                            exists = true;
                            return false;
                        }
                    });

                    if (exists) {
                        alert("The item code already exists in the second table!");
                        return;
                    }

                    // Masukkan data ke tabel kedua
                    var table = $("#tableList1").DataTable();
                    var qty = 0; // Default jumlah item 0
                    var totalPrice = qty * itemPrice;

                    table.row.add([
                        itemCode,
                        itemName,
                        stock,
                        `<input type="text" name="qty" required class="qty-input inputTag" autocomplete="off" />`,
                        sellingUnit,
                        itemPrice.toFixed(2), // Harga item
                        totalPrice.toFixed(2), // Total harga
                        `<button type="button" class="btn btn-danger btn-sm buttonMinus">
                            <i class="ti ti-minus" style="font-size: 10px;"></i>
                        </button>`
                    ]).draw(false);

                    // Menyisipkan baris yang baru dibuat di posisi pertama
                    table.rows().every(function() {
                        this.node().parentNode.insertBefore(this.node(), this.node().parentNode.firstChild);
                    });

                    autoNum();
                });

                function autoNum() {
                    // Cari elemen yang belum diinisialisasi oleh AutoNumeric
                    $('.qty-input:not(.auto-numeric-initialized)').each(function() {
                        // Inisialisasi AutoNumeric
                        new AutoNumeric(this, {
                            maximumValue: '999999999999',
                            minimumValue: '0',
                            decimalPlaces: '2',
                            digitGroupSeparator: '',
                            unformatOnSubmit: true
                        });

                        // Tambahkan class untuk menandai elemen sudah diinisialisasi
                        $(this).addClass('auto-numeric-initialized');
                    });
                }

                autoNum();

                // Event handler untuk perubahan input Qty
                $("#tableList1 tbody").on("input", ".qty-input", function() {
                    var qtyInput = $(this);
                    var row = qtyInput.closest("tr");

                    var qty = parseFloat(qtyInput.val());

                    var stock = parseFloat(row.find("td").eq(2).text());
                    if (qty > stock) {
                        alert("Stock is insufficient!");
                        return;
                    }

                    // Update total item price (baris yang diedit)
                    var itemPrice = parseFloat(row.find("td").eq(5).text());
                    var totalPrice = qty * itemPrice;
                    row.find("td").eq(6).text(totalPrice.toFixed(2));

                    // Update total harga untuk seluruh baris
                    updateTotalHarga();
                });

                // Fungsi untuk menghitung dan menampilkan total harga
                function updateTotalHarga() {
                    var totalHarga = 0;

                    // Iterasi melalui setiap baris dalam tabel
                    $("#tableList1 tbody tr").each(function() {
                        var row = $(this);
                        var rowTotalPrice = parseFloat(row.find("td").eq(6).text()); // Ambil total price dari kolom ke-7
                        if (!isNaN(rowTotalPrice)) {
                            totalHarga += rowTotalPrice;
                        } else {
                            totalHarga = 0;
                            return false;
                        }
                    });

                    var formattedTotalHarga = formatRupiah(totalHarga);

                    $(".totalHarga").text(formattedTotalHarga);
                }

                // Fungsi untuk format angka ke format Rupiah
                function formatRupiah(amount) {
                    let formatted = amount.toFixed(2).replace('.', ',');
                    let parts = formatted.split(',');
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    return "Rp " + parts.join(',');
                }

                // Event handler untuk tombol hapus di tabel kedua
                $("#tableList1 tbody").on("click", ".buttonMinus", function() {
                    var table = $("#tableList1").DataTable();
                    table.row($(this).parents("tr")).remove().draw();
                });

                // Event handler untuk tombol reset
                $(".buttonReset").click(function() {
                    var table = $("#tableList1").DataTable();
                    table.clear().draw();
                    $(".totalHarga").text("Rp 0,00");
                });
            </script>

            {{-- Js di dalam Modal Box --}}
            <script>
                // Inisialisasi AutoNumeric untuk satu input
                new AutoNumeric('.autoNumInputModal', {
                    maximumValue: '999999999999',
                    minimumValue: '0',
                    decimalPlaces: '0',
                    decimalCharacter: ',',
                    digitGroupSeparator: '.',
                    unformatOnSubmit: true
                });

                // Event handler untuk tombol Pay
                $(".buttonPay").click(function(event) {
                    var table = $("#tableList1").DataTable();
                    var table1 = $("#tableList2").DataTable();

                    if (table.rows().count() === 0) {
                        alert("No items have been purchased.");
                        event.preventDefault();
                    } else {
                        var cekQty = true;
                        $("#tableList1 tbody tr").each(function() {
                            var row = $(this);
                            var rowTotalPrice = parseFloat(row.find("td").eq(6)
                                .text());
                            if (rowTotalPrice === 0 || isNaN(rowTotalPrice)) {
                                cekQty = false;
                                return false;
                            }
                        });

                        if (!cekQty) {
                            alert("Qty is empty or 0!");
                            event.preventDefault();
                        } else {
                            table1.clear();

                            table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                                var data = this.node();
                                var itemCode = $(data).find("td").eq(0).text();
                                var itemName = $(data).find("td").eq(1).text();
                                var qtyInput = $(data).find("td").eq(3).find("input").val();
                                var sellingUnit = $(data).find("td").eq(4).text();
                                var itemPrice = $(data).find("td").eq(5).text();
                                var totalItemPrice = $(data).find("td").eq(6).text();

                                var newRow = [
                                    rowIdx + 1,
                                    itemCode,
                                    itemName,
                                    `<input type="text" value="${qtyInput}" name="quantity[]" readonly class="form-control inputTag">
                                    <input type="hidden" name="item_code[]" value="${itemCode}">`,
                                    sellingUnit,
                                    itemPrice,
                                    totalItemPrice
                                ];

                                table1.row.add(newRow);
                            });

                            table1.draw();

                            $(".totalHargaModal").text($(".totalHarga").text());

                            $('#staticBackdrop').modal('show');
                        }
                    }
                });

                $("#uangDiterima").on("input", function() {
                    var uangDiterima = $(this).val().replace(/[^\d,-]/g, ''); // Menghapus karakter selain angka dan koma

                    var totalHargaModal = $(".totalHargaModal").text()
                        .replace(/[^\d,-]/g, '') // Menghapus simbol selain angka dan koma
                        .replace(',', '.'); // Ganti koma desimal menjadi titik

                    uangDiterima = parseFloat(uangDiterima) || 0;
                    totalHargaModal = parseFloat(totalHargaModal) || 0;

                    var uangKembali = uangDiterima - totalHargaModal;

                    console.log(totalHargaModal);
                    $(".totalHargaModalInput").val(totalHargaModal);

                    if (uangKembali <= 0) {
                        uangKembali = 0;
                    }

                    var uangKembaliFormatted = uangKembali.toLocaleString('id-ID'); // Format angka dengan pemisah ribuan

                    $("#uangKembali").val(uangKembaliFormatted);
                });

                $(document).ready(function() {
                    $("#submitBtn").click(function(event) {
                        var uangDiterima = $("#uangDiterima").val().replace(/[^\d,-]/g, '');

                        var totalHargaModal = $(".totalHargaModal").text()
                            .replace(/[^\d,-]/g, '') // Menghapus simbol selain angka dan koma
                            .replace(',', '.'); // Ganti koma desimal menjadi titik
                        console.log(uangDiterima + " dan " + totalHargaModal);
                        uangDiterima = parseFloat(uangDiterima) || 0;
                        totalHargaModal = parseFloat(totalHargaModal) || 0;

                        var uangKembali = uangDiterima - totalHargaModal;
                        console.log(uangKembali);
                        if (uangKembali < 0) {
                            alert("Insufficient payment amount!");
                            event.preventDefault(); // Membatalkan submit form
                        } else {
                            var confirmation = confirm('Can you check if the payment matches the bill ?');
                            if (!confirmation) {
                                event.preventDefault(); // Membatalkan submit form jika user memilih 'Cancel'
                            }
                        }
                    });
                });
            </script>
        @endpush
</x-app-layout>
