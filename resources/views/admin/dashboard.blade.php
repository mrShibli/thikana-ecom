@extends('layouts.master')

@section('content')
    <div class="sm-chart-sec mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
                    <!-- <div class="revinue revinue-one_hybrid">
                                <div class="revinue-heading">
                                    <div class="w-title d-flex align-content-center">
                                        <div class="w-icon">
                                            <span class="fas fa-user text-white fs-4"></span>
                                        </div>
                                        <div class="sm-chart-check">
                                            <h5 class="text-white fs-5 fw-bold">99.99k</h5>
                                            <p class="w-value text-white fs-6 fw-normal">Followers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="revinue-content">
                                    <div id="hybrid_followers"></div>
                                </div>
                            </div> -->
                    <div class="glowcard glowcard1">
                        <div class="glowcard-content">
                            <span class="icon"><span class="fas fa-chart-simple text-white fs-4"></span></span>
                            <div>
                                <div class="count">990</div>
                                <div class="label">Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
                    <!-- <div class="revinue revinue-one_hybrid">
                                <div class="revinue-heading">
                                    <div class="w-title d-flex align-content-center">
                                        <div class="w-icon">
                                            <span class="fas fa-book text-white fs-4"></span>
                                        </div>
                                        <div class="sm-chart-check">
                                            <h5 class="text-white fs-5 fw-bold">200.99k</h5>
                                            <p class="w-value text-white fs-6 fw-normal">Page View</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="revinue-content">
                                    <div id="hybrid_followers"></div>
                                </div>
                            </div> -->
                    <div class="glowcard glowcard2">
                        <div class="glowcard-content">
                            <span class="icon"><span class="fas fa-book text-white fs-4"></span></span></span>
                            <div>
                                <div class="count">200.99k</div>
                                <div class="label">Page View</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
                    <!-- <div class="revinue revinue-one_hybrid">
                                <div class="revinue-heading">
                                    <div class="w-title d-flex align-content-center">
                                        <div class="w-icon">
                                            <span class="fas fa-heart text-white fs-4"></span>
                                        </div>
                                        <div class="sm-chart-check">
                                            <h5 class="text-white fs-5 fw-bold">$500</h5>
                                            <p class="w-value text-white fs-6 fw-normal">Bonuce Rate</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="revinue-content">
                                    <div id="hybrid_followers"></div>
                                </div>
                            </div> -->
                    <div class="glowcard glowcard3">
                        <div class="glowcard-content">
                            <span class="icon"><span class="fas fa-user text-white fs-4"></span></span>
                            <div>
                                <div class="count">300</div>
                                <div class="label">Customers</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
                    <!-- <div class="revinue revinue-one_hybrid">
                                <div class="revinue-heading">
                                    <div class="w-title d-flex align-content-center">
                                        <div class="w-icon">
                                            <span class="fa-solid fa-chart-simple text-white fs-4"></span>
                                        </div>
                                        <div class="sm-chart-check">
                                            <h5 class="text-white fs-5 fw-bold">$950</h5>
                                            <p class="w-value text-white fs-6 fw-normal">Ravenue Status</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="revinue-content">
                                    <div id="hybrid_followers"></div>
                                </div>
                            </div> -->

                    <div class="glowcard glowcard4">
                        <div class="glowcard-content">
                            <span class="icon"><span class="fa-solid fa-chart-simple text-white fs-4"></span></span>
                            <div>
                                <div class="count">500</div>
                                <div class="label">Ravenue Rate</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h5 class="mb-3">Admin Panel Statistics</h5> <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Page Views</h5>
                        <canvas id="totalUsersChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <canvas id="totalOrdersChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <canvas id="totalRevenueChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <section class="deshboard-top-sec border">
        <div class="container-fuild p-2">
            <div class="row ">
                <div class="col-lg-8">
                    <div class="bg-white rounded p-4 top-chart-earn">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="last-month">
                                    <h5>Dashboard</h5>
                                    <p>over view of latest month</p>
                                    <div class="earn">
                                        <h2>$5555.77</h2>
                                        <p>current month sales</p>
                                    </div>
                                    <a href="#" class="di-btn purple-gradient my-2">Last month
                                        summary</a>
                                </div>
                            </div>
                            <!-- --  -->
                            <div class="col-sm-4">
                                <div class="tabs">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">Week</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Month</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-contact" type="button" role="tab"
                                                aria-controls="pills-contact" aria-selected="false">year</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab" tabindex="0">
                                            Lorem ipsum dolor, sit
                                            amet consectetur adipisicing elit. Blanditiis, cupiditate.</div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab" tabindex="0">Lorem ipsum
                                            dolor
                                            sit amet consectetur, adipisicing elit. Tenetur dicta magni
                                            inventore dignissimos, amet animi?</div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                            aria-labelledby="pills-contact-tab" tabindex="0">Lorem ipsum
                                            dolor
                                            sit amet consectetur adipisicing elit. Repellat, corrupti
                                            consequuntur! Quaerat ut iusto eos perferendis magni reiciendis
                                            debitis facilis!</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}

    <div class="container-fluid mb-5 mt-4">
        <div class="row">
            <h6 class="mb-1">Latest All Orders</h6>
            <table class="table table-bordered mt-2 pt-2 mr-2">
                <thead>
                    <tr class="table-info">
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Simulated data (replace with actual data fetching logic)
        const totalUsersData = [100, 150, 200, 250, 300, 350, 400];
        const totalOrdersData = [50, 75, 100, 125, 150, 175, 200];
        const totalRevenueData = [5000, 7500, 10000, 12500, 15000, 17500, 20000];

        // Total Users Chart
        var totalUsersChart = new Chart(document.getElementById('totalUsersChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Total Users',
                    data: totalUsersData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Total Orders Chart
        var totalOrdersChart = new Chart(document.getElementById('totalOrdersChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Total Orders',
                    data: totalOrdersData,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Total Revenue Chart
        var totalRevenueChart = new Chart(document.getElementById('totalRevenueChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Total Revenue',
                    data: totalRevenueData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
