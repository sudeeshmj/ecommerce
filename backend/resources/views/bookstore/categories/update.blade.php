<div class="modal fade" id="categoryUpdateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="category-modal-title">Edit Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" id="category_update_form" > 
          @csrf
          @method('PUT')
        <div class="modal-body">
            <input type="hidden" name="category_id"  id="category_id">
            <div class="form-group mb-3">
              <label for="category_name" class="col-form-label">Category Name:</label>
              <input type="text" class="form-control" id="category_edt_name" name="category_edt_name" required >
            </div>
            <div class="form-group">
              <label for="status" class="col-form-label">Status:</label>
              <select class="form-control" name="category_status" id="category_status" required >
                <option value="">Select Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm close_btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn  btn-primary btn-sm add_new_btn">Update</button>
        </div>
      </form>
      </div>
    </div>
  </div>