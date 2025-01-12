@extends('layouts.master')
@section('admincontent')

  <section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">
            
            <div class="page-title mt-2">
              <div class="row d-flex align-items-center">
                <div class="col-6">
                  <h4 class="page-header">Book List</h4>
                </div>
                <div class="col-6 ">
                  <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">Books</li>
                  </ol>
                   
                </div>
              </div>
            </div>

            <div class="card">
                <div class="card-body">   
                  <input type="hidden" id="book-add-view-url"  data-route="{{ route('books.create') }}" >  
                  <table class="table datatable-table" id="books-data-table" data-route="{{ route('books.index') }}">
                    <thead>
                      <tr>
                        <th>#</th>
                      
                        <th>Title</th>
                        <th>Author</th>
                        <th>Language</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                      
                        <th>Title</th>
                        <th>Author</th>
                        <th>Language</th>
                        <th>Price</th>
                        <th>Stock</th>
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
