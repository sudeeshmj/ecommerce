@extends('layouts.master')
@section('admincontent')
<style>
  .author-profile-container{
      width: 70%
  }
  
  .author-image-section .profile-image{
          width: 90px;
          height: 90px;
  }
  </style>
  <section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-7">
            <div class="card mt-4">
                <div class="card-header">
                  <h6>Update Author</h6>
                </div>
                <div class="card-body">    
                  <form  method="POST" id="bookSubmitForm" action="{{ route('authors.update',['author' =>$author->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" value="{{ old('name') ?old('name'): $author->name }}" class='form-control @error("name") is-invalid @enderror' id="name"   name="name" >
                        @error('name')
                        <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div> 
                    <div class="form-group mb-3">
                        <label for="bio" class="col-form-label">Summary:</label>
                       <textarea name="bio" class="form-control @error("bio") is-invalid @enderror" id="bio" cols="30" rows="10" >
                      
                        @if (old('bio'))
                                {{ old('bio') }}
                              
                          @else
                                {{  $author->bio }}
                          @endif
                       
                       </textarea>
                       @error('bio')
                          <div class="invalid-feedback">{{ $message  }}</div>
                       @enderror
                    </div> 
                </div>
           </div>
        </div>
           <div class="col-4">
            <div class="card mt-4">
                <div class="card-header">
                  <h6 class="language_form_title">Author Image</h6>
                </div>
                <div class="card-body">     
                 
                    <div class="form-group mb-3">
                     

                      <div class="author-image-section">
                          <img src="{{ $author->image ? asset('images/uploads/authors/' . $author->image) : asset('images/profile.png') }}" id="author-profile-img" alt="" class="rounded-circle img-fluid img-thumbnail profile-image" required>

                       </div>
                       

                      <input type="file" id="upload" name="author_image" accept='image/*'  hidden  />
                      <label for="upload" class="file-upload-label btn btn-sm btn-book-img-upload">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        Upload Image
                      </label>

                    
                    </div>

                    <div class="form-group">
                  
                     
                      <button type="submit" class="btn float-right btn-primary btn-sm add_new_btn" id="btn_language_form">Create</button>
                    </div>

                  <form>
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

  </section>
    

  <script>





    $(document).ready(function() {

    
    
        $(document).on("change", "#upload", function (event) {
      
          var image = $('#author-profile-img');
          image.attr('src', URL.createObjectURL(event.target.files[0]));
      
        });

   
        

    });

  
    



</script>

  @endsection
