@extends('layouts.master')
@section('admincontent')
<style>
    .datatable td, .datatables th {
    vertical-align: middle; /* Vertically center the content in table cells */
   
}
    </style>
  <section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">

            <div class="page-title mt-2">
              <div class="row d-flex align-items-center">
                <div class="col-6">
                  <h4 class="page-header">Author List</h4>
                </div>
                <div class="col-6 ">
                  <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">Authors</li>
                  </ol>
                   
                </div>
              </div>
            </div>

            <div class="card">
                <div class="card-body"> 
                  <input type="hidden" id="author-add-view-url"  data-route="{{ route('authors.create') }}" >  

                  <table class="table datatable-table" id="authors-data-table" data-route="{{ route('authors.index') }}">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
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



    @include('bookstore.authors.delete') 





  </section>

  @endsection
