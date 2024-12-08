<x-app-layout>
    <div class="container-fluid">
        {{-- Baris 1 --}}
        <div class="row g-3 pb-3">
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold"> Total Sales Today </h5>
                                <div id="loading_totalSalesToday" style="display: none;">
                                    <i class="ti ti-loader" style="font-size: 35px;"></i>
                                </div>
                                <h4 class="fw-semibold" id="totalSalesToday"></h4>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div
                                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-currency-dollar fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold"> Total Successful Transactions Today </h5>
                                <div id="loading_totalSuccessfulTransactionsToday" style="display: none;">
                                    <i class="ti ti-loader" style="font-size: 35px;"></i>
                                </div>
                                <h4 class="fw-semibold" id="totalSuccessfulTransactionsToday"></h4>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div
                                        class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-check fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold"> Out of Stock or Nearly Out of Stock </h5>
                                <div id="loading_outofStockorNearlyOutofStock" style="display: none;">
                                    <i class="ti ti-loader" style="font-size: 35px;"></i>
                                </div>
                                <h4 class="fw-semibold" id="outofStockorNearlyOutofStock"></h4>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div
                                        class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-alert-triangle fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Baris 2 --}}
        <div class="row g-3 pb-3">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100%; margin: auto; height: 100%;">
                            <canvas id="monthlySalesLineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100%; margin: auto; height: 100%;">
                            <canvas id="topItemsBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card {
                height: 100%;
            }
        </style>
    @endpush

    @push('scripts')
        {{-- Datatables --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        {{-- Chart --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {{-- Table --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableList').DataTable({

                })
            });
        </script>

        {{-- Line Chart (Daily Sales = monthlySalesLineChart) --}}
        <script>
            const ctx = document.getElementById('monthlySalesLineChart').getContext('2d');
            let monthlySalesLineChart;

            function loadMonthlySales() {
                $.ajax({
                    url: "{{ route('dashboard.monthlySales') }}",
                    method: 'GET',
                    success: function(response) {
                        const labels = response.labels;
                        const salesData = response.sales;

                        // Perbarui atau buat chart
                        if (monthlySalesLineChart) {
                            monthlySalesLineChart.data.labels = labels;
                            monthlySalesLineChart.data.datasets[0].data = salesData;
                            monthlySalesLineChart.update();
                        } else {
                            monthlySalesLineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Monthly Sales',
                                        data: salesData,
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderWidth: 2,
                                        pointRadius: 5,
                                        pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Monthly Sales Trend',
                                            font: {
                                                size: 20
                                            },
                                            padding: {
                                                top: 10,
                                                bottom: 30
                                            }
                                        },
                                        legend: {
                                            display: true,
                                            position: 'top'
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    // let value = context.raw;
                                                    // return `Rp ${value.toLocaleString('id-ID')}`;

                                                    let value = context.raw; // Nilai asli dari dataset
                                                    let formattedValue = new Intl.NumberFormat(
                                                        'id-ID', {
                                                            style: 'currency',
                                                            currency: 'IDR',
                                                            minimumFractionDigits: 0 // Tidak ada desimal
                                                        }).format(value);

                                                    return formattedValue.replace('IDR', 'Rp')
                                                        .trim(); // Ganti 'IDR' dengan 'Rp'
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Month / Year'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Sales Amount (Rp)'
                                            },
                                            ticks: {
                                                callback: function(value) {
                                                    return `Rp ${value.toLocaleString('id-ID')}`;
                                                }
                                            },
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load monthly sales data:', error);
                    }
                });
            }

            // Panggil fungsi saat halaman dimuat
            $(document).ready(function() {
                loadMonthlySales();
            });
        </script>

        {{-- Bar Chart (Top 5 Best-Selling Items = topItemsBarChart) --}}
        <script>
            const ctxBar = document.getElementById('topItemsBarChart').getContext('2d');
            let topItemsBarChart;

            function loadtopItems() {
                $.ajax({
                    url: "{{ route('dashboard.topItems') }}",
                    method: 'GET',
                    success: function(response) {
                        const labels = response.labels;
                        const salesData = response.sales;

                        // Perbarui atau buat chart
                        if (topItemsBarChart) {
                            topItemsBarChart.data.labels = labels;
                            topItemsBarChart.data.datasets[0].data = salesData;
                            topItemsBarChart.update();
                        } else {
                            const topItemsBarChart = new Chart(ctxBar, {
                                type: 'bar',
                                data: {
                                    labels: labels, // Sumbu X
                                    datasets: [{
                                        label: '(Kg / Satuan) Sold',
                                        data: salesData, // Sumbu Y
                                        backgroundColor: [
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(153, 102, 255, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(153, 102, 255, 1)'
                                        ],
                                        borderWidth: 2
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Top 5 Best-Selling Items',
                                            font: {
                                                size: 20
                                            },
                                            padding: {
                                                top: 10,
                                                bottom: 30
                                            }
                                        },
                                        legend: {
                                            display: false // Tidak menampilkan legend, karena label ada di sumbu X
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    let value = context.raw;
                                                    return `${value} (Kg / Satuan) sold`;
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Product Items'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: '(Kg / Satuan) Sold'
                                            },
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load top 5 best-selling items:', error);
                    }
                });
            }

            // Panggil fungsi saat halaman dimuat
            $(document).ready(function() {
                loadtopItems();
            });
        </script>
        <script></script>

        {{-- Ajax --}}
        <script>
            $(document).ready(function() {
                // Total Sales Today (totalSalesToday)
                $('#loading_totalSalesToday').show();
                $.ajax({
                    url: "{{ route('dashboard.totalSalesToday') }}",
                    method: 'GET',
                    success: function(response) {
                        $('#totalSalesToday').text(response.totalSales);
                        $('#loading_totalSalesToday').hide();
                    },
                    error: function(xhr, status, error) {
                        $('#totalSalesToday').text('Failed to load total sales today.');
                        $('#loading_totalSalesToday').hide();
                    }
                });

                // Total Successful Transactions Today (totalSuccessfulTransactionsToday)
                $('#loading_totalSuccessfulTransactionsToday').show();
                $.ajax({
                    url: "{{ route('dashboard.totalSuccessfulTransactionsToday') }}",
                    method: 'GET',
                    success: function(response) {
                        $('#totalSuccessfulTransactionsToday').text(response.totalTransaction);
                        $('#loading_totalSuccessfulTransactionsToday').hide();
                    },
                    error: function(xhr, status, error) {
                        $('#totalSuccessfulTransactionsToday').text(
                            'Failed to load total transactions today.');
                        $('#loading_totalSuccessfulTransactionsToday').hide();
                    }
                });

                // Out of Stock or Nearly Out of Stock (outofStockorNearlyOutofStock)
                $('#loading_outofStockorNearlyOutofStock').show();
                $.ajax({
                    url: "{{ route('dashboard.outofStockorNearlyOutofStock') }}",
                    method: 'GET',
                    success: function(response) {
                        $('#outofStockorNearlyOutofStock').text(response.totalItemsRestocking);
                        $('#loading_outofStockorNearlyOutofStock').hide();
                    },
                    error: function(xhr, status, error) {
                        $('#outofStockorNearlyOutofStock').text('Failed to load total items restocking.');
                        $('#loading_outofStockorNearlyOutofStock').hide();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
