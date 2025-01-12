@extends('layouts.master')
@section('admincontent')
    <style>
        .table th,
        table tr>td {
            padding: 18px 10px !important;
            border: none !important;
        }

        .table tr {
            border-bottom-width: 1px;
            border-bottom-style: dashed;
            border-bottom-color: #F1F1F4;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">

                    {{-- <div class="page-title mt-2">
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
        </div> --}}

                    <div class="card order-details-head">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-xl-6">
                                    <div class="order-details">
                                        <div>
                                            <span>Order #{{ $order->id }}</span>
                                            <span class="badge badge-secondary">{{ $order->payment_status_text }}</span>
                                            <span id="orderStatusLabel"
                                                class=" {{ renderOrderStatus($order->orderStatus->status) }}">{{ $order->orderStatus->status }}</span>
                                        </div>
                                        <p class="mb-0">{{ $order->order_date }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="order-actions d-flex justify-content-xl-end" style="gap: 12px">
                                        <select class="form-control w-auto" name="orderStatus" id="orderStatus">
                                            @foreach ($orderStatuses as $orderStatus)
                                                <option {{ $orderStatus->id == $order->order_status ? 'selected' : '' }}
                                                    value="{{ $orderStatus->id }}">{{ $orderStatus->status }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-secondary">
                                            <i class="fa fa-download" aria-hidden="true"></i>Invoice</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-details-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header pt-4 pb-0" style="border-bottom:none !important">
                                        <span class="f-black">ORDER DETAILS</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width:50%">Product</th>
                                                        <th class="text-center">Price</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $subTotal = 0;
                                                        $netTotal = 0;
                                                        $vat = 0;
                                                    @endphp



                                                    @forelse ($order->orderItems as $orderItem)
                                                        @php
                                                            $total =
                                                                (int) $orderItem->price * (int) $orderItem->quantity;
                                                            $subTotal = (int) $subTotal + (int) $total;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $orderItem->book->title }}</td>
                                                            <td class="text-center">${{ $orderItem->price }}</td>
                                                            <td class="text-center">{{ $orderItem->quantity }}</td>
                                                            <td class="text-right">${{ $total }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">No Order Item Found</td>
                                                        </tr>
                                                    @endforelse
                                                    @if (!$order->orderItems->isEmpty())
                                                        <tr>

                                                            <td colspan="3" class="text-right">Subtotal</td>
                                                            <td class="text-right">${{ $subTotal }}</td>
                                                        </tr>
                                                        <tr>

                                                            <td colspan="3" class="text-right">VAT</td>
                                                            <td class="text-right">${{ $vat }}</td>
                                                        </tr>
                                                        <tr>

                                                            <td colspan="3" class="text-right">Shipping</td>
                                                            <td class="text-right">${{ $order->shipping_charge }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $subTotal =
                                                                    $vat + $subTotal + (int) $order->shipping_charge;
                                                            @endphp
                                                            <td colspan="3" class="text-right">Total</td>
                                                            <td class="text-right">${{ $subTotal }}</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 order-details-content">
                                <div class="card p-2 shadow-sm" style="border-radius: 8px;">
                                    <div class="card-body">
                                        <!-- Customer Info -->
                                        <div class="customer-info mb-4">
                                            <h6 class="title mb-3 text-uppercase f-black" style="font-size: 14px;">
                                                Customer Info</h6>
                                            <div class="content d-flex align-items-center">
                                                <div class="avatar mr-3">
                                                    <img src="{{ asset('images/uploads/customers/' . $order->customer->image) }}"
                                                        width="50" class="img-fluid rounded-circle border"
                                                        alt="Customer Avatar" />
                                                </div>
                                                <div class="customer-data">
                                                    <strong
                                                        style="font-size: 16px;font-weight: 600; color: #007bff;">{{ $order->customer->customer_name }}</strong>
                                                    <br>
                                                    <span style="">{{ $order->customer->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="full-width-divider my-4" style="margin: 0 -26px; ">
                                            <hr style="border: 0;  border-top: 1px solid #e9ecef;">
                                        </div>
                                        <!-- Divider -->
                                        {{-- <hr class="my-4"
                                            style="border: 0; margin: 0px -2rem; border-top: 1px solid #e9ecef; width: 100%;"> --}}

                                        <!-- Shipping Info -->
                                        <div class="shipping-info mb-4">
                                            <h6 class="title mb-3 text-uppercase f-black" style="font-size: 14px;">
                                                Shipping Address</h6>
                                            <div class="content">
                                                <p style="font-size: 14px; color: #495057;">
                                                    {{ $order->orderShippingAddress ? $order->orderShippingAddress->address : '' }}
                                                </p>
                                                <p style="font-size: 14px; color: #495057;">
                                                    Phone :
                                                    {{ $order->orderShippingAddress ? $order->orderShippingAddress->phone_number : '' }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Divider -->
                                        <div class="full-width-divider my-4" style="margin: 0 -26px; ">
                                            <hr style="border: 0;  border-top: 1px solid #e9ecef;">
                                        </div>

                                        <!-- Billing Info -->
                                        <div class="billing-info">
                                            <h6 class="title mb-3 text-uppercase f-black" style="font-size: 14px;">
                                                Billing Address</h6>
                                            <div class="content">
                                                <p style="font-size: 14px; color: #495057;">
                                                    {{ $order->orderShippingAddress ? $order->orderShippingAddress->address : '' }}
                                                </p>
                                                <p style="font-size: 14px; color: #495057;">
                                                    Phone :
                                                    {{ $order->orderShippingAddress ? $order->orderShippingAddress->phone_number : '' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
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
    <script>
        $(document).ready(function() {


            $(document).on("change", "#orderStatus", function(event) {

                const status = $(this).val();
                const orderId = "{{ $order->id }}";
                if (status) {
                    $.ajax({
                        url: "{{ route('change.orderstatus') }}",
                        type: "POST",
                        data: {
                            status: status,
                            id: orderId,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.error) {
                                toastr.error(result.message)
                            } else {
                                $('#orderStatusLabel')
                                    .removeClass()
                                    .addClass(renderOrderStatus(result.data.order_status_text))
                                    .text(result.data.order_status_text);
                                toastr.success(result.message)
                            }
                        },
                        error: function(err) {
                            toastr.error("Something went wrong")
                        }
                    });
                }

            });

        });


        function renderOrderStatus(data) {
            const statusClasses = {
                "Confirmed": "badge badge-light-confirm",
                "Shipped": "badge badge-light-warning",
                "Out For Delivery": "badge badge-light-primary",
                "Delivered": "badge badge-light-success",
                "Cancelled": "badge badge-light-danger",
                "Return": "badge badge-light-return",
                "Ready to Pickup": "badge badge-light-info",
                "Refund": "badge badge-light-refund"
            };

            return statusClasses[data] || "badge-status";
        }
    </script>


@endsection
