@extends('layouts.master')
@section('admincontent')

  <section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">
            
            <div class="page-title mt-2">
              <div class="row d-flex align-items-center">
                <div class="col-6">
                  <h4 class="page-header">Customer List</h4>
                </div>
                <div class="col-6 ">
                  <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">Customers</li>
                  </ol>
                   
                </div>
              </div>
            </div>

            <div class="card">
                <div class="card-body">   
                  <table class="table datatable-table" id="customers-data-table" data-route="{{ route('customers.index') }}">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Order</th>
                        <th>Total Spent</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Order</th>
                        <th>Total Spent</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
            </div>
           </div>
        </div>
    </div><!-- /.container-fluid -->

    @if (session()->has('success'))
        <script>toastr.success("{{ session()->get('success') }}")</script>      
    @endif
  
    @if (session()->has('error'))
        <script>toastr.error("{{ session()->get('error') }}")</script> 
    @endif


  </section>

  @endsection
