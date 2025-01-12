<div class="modal fade" id="authorDeleteModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         
          <h6 class="modal-title" id="exampleModalLabel">Delete Author</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deleteForm" method="POST">
        <div class="modal-body">
           
           
                @csrf
                @method('DELETE')
                <h6>Are you sure do you want  to delete?</h6>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm close_btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn  btn-primary btn-sm btn-danger">Delete</button>
        </div>
      </form>
      </div>
    </div>
  </div>