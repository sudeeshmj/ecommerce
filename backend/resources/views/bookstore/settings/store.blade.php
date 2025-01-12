<div class="tab-pane fade show active" id="v-pills-store" role="tabpanel" >

    <form method="POST" id="storeSettingForm"  data-url="{{ route('settings.store.store') }}" enctype="multipart/form-data"> 
      @csrf
        <div class="form-group mb-3">
            <label for="store_name" class="col-form-label">Store Name:</label>
            <input type="text" class='form-control @error("store_name") is-invalid @enderror' id="store_name"  value={{ $storeInfo->store_name }} name="store_name"  required>
            @error('store_name')
            <div class="invalid-feedback">{{ $message  }}</div>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="store_email"  class="col-form-label">Email:</label>
            <input type="text" class='form-control @error("store_email") is-invalid @enderror' value={{ $storeInfo->store_email }} id="store_email"   name="store_email" required>
            @error('store_email')
            <div class="invalid-feedback">{{ $message  }}</div>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="store_phone" class="col-form-label">Phone Number:</label>
            <input type="text" class='form-control @error("store_phone") is-invalid @enderror' value={{ $storeInfo->store_phone }} id="store_phone"   name="store_phone" required >
            @error('store_phone')
            <div class="invalid-feedback">{{ $message  }}</div>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="store_address" class="col-form-label">Address:</label>
            <textarea cols="30" rows="5"  class="form-control"  name="store_address" required>{{ $storeInfo->store_address}}</textarea>  
            @error('category_name')
            <div class="invalid-feedback">{{ $message  }}</div>
            @enderror
          </div>
          <div class="form-group mb-4">
            <label for="dropzone" class="col-form-label">Logo:</label>
            <div    class="dropzone" id="my-great-dropzone" data-url="{{ route('categories.store') }}"></div>
         </div>
          <div class="form-group mb-3 text-right">
            <input type="hidden" name="store_id" value={{  $storeInfo->id }}>
            <button type="submit" class="btn  btn-primary btn-sm add_new_btn">Save</button>
          </div>
          
    </form>


<script type="text/javascript">

  Dropzone.autoDiscover = false;
  $(document).ready(function() {   
    // Manually initialize Dropzone
      const myDropzone = new Dropzone("#my-great-dropzone", {
          url: "{{ route('settings.store.store') }}", // Adjust to your upload route
          paramName: "store_logo",
          maxFilesize: 2, // MB
          maxFiles: 1,
        
          autoProcessQueue: false, // Prevent automatic upload
          addRemoveLinks: true,
          acceptedFiles: "image/*",
      });

      //form submission
      $("#storeSettingForm").submit(function(e){
          e.preventDefault();
         const data = new FormData(this);
         const routeUrl = $(this).data('url');
        
         var dropzoneFile = myDropzone.files[0]; // Only one file
        if (dropzoneFile) {
            data.append('store_logo', dropzoneFile);
        }

         $.ajax({
            type: "POST",
            url: routeUrl,
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === 400) {
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");

                    $.each(response.error, function (field, message) {
                        var fieldId = "#" + field;
                        const newDiv = $(
                            '<div class="invalid-feedback">' +
                                message +
                                "</div>"
                        );
                        $(fieldId).addClass("is-invalid");
                        $(fieldId).after(newDiv);
                    });
                } else {
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");
                    toastr.success(response.message);
                }
            },
            error: function (err) {
                console.log(err);
            },
        });
      });
  });


</script>
</div>
                      