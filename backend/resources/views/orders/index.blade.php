@extends('layouts.master')
@section('admincontent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="page-title mt-2">
                        <div class="row d-flex align-items-center">
                            <div class="col-6">
                                <h4 class="page-header">Order List</h4>
                            </div>
                            <div class="col-6 ">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i></li>
                                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                                </ol>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        {{-- <div class="card-header">
                            <div class="card-title">
                                <a href="" class="mr-4 text-muted" style="font-size: 12px">All<span
                                        class="badge badge-sm badge-success">0</span>
                                </a>
                                <a href="" class="mr-4 text-muted" style="font-size: 12px">Confirmed<span
                                        class="badge badge-sm badge-success">0</span>
                                </a>
                                <a href="" class="mr-4 text-muted" style="font-size: 12px"> Delivered<span
                                        class="badge badge-sm badge-success">0</span>
                                </a>
                                <a href="" class="mr-4 text-muted" style="font-size: 12px"> Cancelled<span
                                        class="badge badge-sm badge-success">0</span>
                                </a>
                                <a href="" class="mr-4 text-muted" style="font-size: 12px"> Return<span
                                        class="badge badge-sm badge-success">0</span>
                                </a>
                                <a href="" class="mr-4 text-muted" style="font-size: 12px"> Penidng Payment<span
                                        class="badge badge-sm badge-success">0</span>
                                </a>

                            </div>

                        </div> --}}
                        <div class="card-body">
                            <table class="table datatable-table" id="orders-data-table"
                                data-route="{{ route('orders.index') }}">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

            @if (session()->has('success'))
                <script>
                    toastr.success("{{ session()->get('success') }}")
                </script>
            @endif

            @if (session()->has('error'))
                <script>
                    toastr.error("{{ session()->get('error') }}")
                </script>
            @endif


    </section>
@endsection
