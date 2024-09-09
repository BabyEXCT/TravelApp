

<x-app-layout :assets="$assets ?? []">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="row">
        <!-- Total Users Widget -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bg-info text-white rounded p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-end">
                            <p>Total Users</p>
                            <h2 class="counter">{{ $totalUsers ?? 'N/A' }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Packages Widget -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bg-info text-white rounded p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z"/>
                            </svg>
                        </div>
                        <div class="text-end">
                            <p>Total Packages</p>
                            <h2 class="counter">{{ $totalPackages ?? 'N/A' }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Payments Widget -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bg-info text-white rounded p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z"/>
                            </svg>
                        </div>
                        <div class="text-end">
                            <p>Total Payments</p>
                            <h2 class="counter">RM {{ number_format($totalPayments ?? 0, 2) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Postings Widget -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bg-info text-white rounded p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm2 0v12h14V6H5zm7 7a2 2 0 100-4 2 2 0 000 4zm0-6a4 4 0 11-4 4 4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div class="text-end">
                            <p>Total Postings</p>
                            <h2 class="counter">{{ $totalPostings ?? 'N/A' }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Analytics Section -->
        <div class="col-lg-6">
            <div class="card bg-white-primary">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="mb-3">
                            <h2>Analytics</h2>
                            <span class="text-primary">Gross Sales</span>
                        </div>
                        <div id="extrachart" style="min-height: 320px;">
                            <div id="apexchartsy7dsqza0j" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Packages Section -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Upcoming Packages</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Start Date</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->details }}</td>
                                    <td>{{ \Carbon\Carbon::parse($package->start_date)->format('d M Y') }}</td>
                                    <td>{{ $package->duration }} Days</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary btn-sm">
                                            <span class="btn-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3" />
                                                </svg>
                                            </span>
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
    </div>

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            series: [{
                name: 'Gross Sales',
                data: {!! json_encode($grossSalesData) !!}
            }],
            chart: {
                type: 'bar',
                height: 250
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: {!! json_encode($months) !!}
            },
            yaxis: {
                title: {
                    text: 'Gross Sales (RM)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "RM " + val;
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apexchartsy7dsqza0j"), options);
        chart.render().catch(function (err) {
            console.error('Chart rendering failed:', err);
        });
    });
    </script>
    @endsection
</x-app-layout>
