<div class="modal fade" id="subCategoryUpdateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="sub-category-modal-title">Edit Sub Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST"  id="subCategoryUpdateForm"  > 
          @csrf
          @method('PUT')
         
        <div class="modal-body">
            <input type="hidden" name="sub_category_id"  id="sub_category_id">
            <div class="form-group mb-2">
                <label for="status" class="col-form-label">Category:</label>
                <select class="form-control" name="category_edt_id" id="category_edt_id" required >
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option> 
                    @endforeach
                </select>
              </div>

            <div class="form-group mb-2">
              <label for="category-name" class="col-form-label">Sub Category Name:</label>
              <input type="text" class='form-control '  name="sub_category_edt_name"  id="sub_category_edt_name" required >
             
             
            </div>

            <div class="form-group">
              <label for="status" class="col-form-label">Status:</label>
              <select class="form-control" name="sub_category_edt_status" id="sub_category_edt_status" required >
                <option value="1" selected  >Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm close_btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn  btn-primary btn-sm add_new_btn">Create</button>
        </div>
      </form>
      </div>
    </div>
</div>