@extends('layouts.master')
@section('admincontent')

  <section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">

            <div class="page-title mt-2">
              <div class="row d-flex align-items-center">
                <div class="col-6">
                  <h4 class="page-header">SubCategory List</h4>
                </div>
                <div class="col-6 ">
                  <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">SubCategories</li>
                  </ol>
                   
                </div>
              </div>
            </div>

            <div class="card">
                <div class="card-body">     
                  <table class="table datatable-table" id="sub-categories-data-table" data-route="{{ route('sub-categories.index') }}">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                       
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
    @include('bookstore.subcategories.create')
    @include('bookstore.subcategories.update')
    @include('bookstore.modals.delete')


  </section>


  @endsection
