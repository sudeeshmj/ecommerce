@extends('layouts.master')
@section('admincontent')

  <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="page-title mt-2">
            <div class="row d-flex align-items-center">
              <div class="col-6">
                <h4 class="page-header">Category List</h4>
              </div>
              <div class="col-6 ">
                <ol class="breadcrumb float-right">
                  <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i></li>
                  <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
                 
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-7 mr-5">
              <div class="card mt">
                  <div class="card-body">    
                    <table class="table datatable-table"  id="language-data-table" data-route="{{ route('languages.index') }}">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        
                        </tr>
                      </tfoot>
                    </table>
                  </div>
            </div>
            </div>
            <div class="col-4">
              <div class="card">
                  <div class="card-header">
                    <h6 class="language_form_title card-title">Add New</h6>
                  </div>
                  <div class="card-body">     
                    <form  method="POST" id="languageSubmitForm" data-url="{{ route('languages.store') }}">
                    
                      <div class="form-group mb-2">
                          <label for="language_name" class="col-form-label">Language:</label>
                          <input type="text" class='form-control @error("language_name") is-invalid @enderror' id="language_name"   name="language_name" >
                          @error('language_name')
                          <div class="invalid-feedback">{{ $message  }}</div>
                          @enderror
                      </div>

                      <div class="form-group mb-3">
                        <label for="status" class="col-form-label">Status:</label>
                        <select class="form-control" name="language_status" id="language_status" required >
                          <option value="">Select Status</option>
                          <option value="1" selected  >Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>

                      <div class="form-group">
                    
                        <input type="hidden" name="language_id"  id="language_id">
                        <button type="submit" class="btn float-right btn-primary btn-sm add_new_btn" id="btn_language_form">Create</button>
                      </div>

                    </form>
                  </div>
            </div>
          </div>
          </div>
        </div>
    </div>

    @if (session()->has('success'))
        <script>toastr.success("{{ session()->get('success') }}")</script>      
    @endif
  
    @if (session()->has('error'))
        <script>toastr.error("{{ session()->get('error') }}")</script> 
    @endif

    @include('bookstore.languages.delete')
  </section>


  @endsection
