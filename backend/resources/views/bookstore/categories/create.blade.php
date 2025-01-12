<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="category-modal-title">{{ __('Add Category') }}</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST"  action="{{ route('categories.store') }}" > 
          @csrf
        <div class="modal-body">
         
            <div class="form-group mb-3">
              <label for="category-name" class="col-form-label">{{ __('Category Name') }}:</label>
              <input type="text" class='form-control @error("category_name") is-invalid @enderror' id="category_name"   name="category_name" >
              @error('category_name')
              <div class="invalid-feedback">{{ $message  }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="status" class="col-form-label">{{ __('Status') }}:</label>
              <select class="form-control" name="status" id="status" required>
                <option value="">Select Status</option>
                <option value="1" selected  >Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm close_btn" data-dismiss="modal">{{ __('Close') }}</button>
          <button type="submit" class="btn  btn-primary btn-sm add_new_btn">{{ __('Create') }}</button>
        </div>
      </form>
      </div>
    </div>
</div>