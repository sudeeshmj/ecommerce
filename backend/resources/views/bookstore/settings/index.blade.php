@extends('layouts.master')
@section('admincontent')

  <section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">

            <div class="page-title mt-2">
              <div class="row d-flex align-items-center">
                <div class="col-6">
                  <h4 class="page-header">Settings</h4>
                </div>
                <div class="col-6 ">
                  <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                  </ol>
                   
                </div>
              </div>
            </div>

            <div class="card">
                <div class="card-body">     
                    <div class="row p-4  d-flex justify-content-between"  >
                        <div class="col-3">
                          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active text-left mb-2  w-auto"  data-toggle="pill" data-target="#v-pills-store" type="button" role="tab"><i class="fa  fa-building mr-2" aria-hidden="true"></i>Store</button>
                            <button class="nav-link text-left mb-2  w-auto"  data-toggle="pill" data-target="#v-pills-notification" type="button" role="tab"  ><i class="fa fa-bell mr-2" aria-hidden="true"></i>Notification</button>
                            <button class="nav-link text-left mb-2  w-auto"  data-toggle="pill" data-target="#v-pills-order" type="button" role="tab" ><i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>Order Settings</button>
                            <button class="nav-link text-left mb-2  w-auto"  data-toggle="pill" data-target="#v-pills-database" type="button" role="tab" ><i class="fa fa-database mr-2" aria-hidden="true"></i>Database</button>
                            <button class="nav-link text-left mb-2 w-auto"  data-toggle="pill" data-target="#v-pills-site" type="button" role="tab" ><i class="fa fa-snowflake mr-2" aria-hidden="true"></i>Site Settings</button>
                          </div>
                        </div>
                        <span class ="border-right"></span>
                        <div class="col-8" >
                          <div class="tab-content" id="v-pills-tabContent">
                            @include('bookstore.settings.store')
                            @include('bookstore.settings.notification')
                            @include('bookstore.settings.order')
                            @include('bookstore.settings.database')
                            @include('bookstore.settings.site')
                          </div>
                        </div>
                      </div>
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
