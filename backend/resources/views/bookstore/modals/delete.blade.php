<style>
    /* Center the modal and set a fixed width */
    #DeleteModal .modal-dialog {
      max-width: 400px;
      margin: auto;
    }
    
    #DeleteModal  .modal-content {
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    #DeleteModal  .modal-body {
      font-size: 13px!important;
      padding: 20px;
    }
    
    .body-content {
      text-align: center;
    }
      
    .body-content h6 {
      font-size: 13px!important;
    }
    .img-fluid {
      height: 80px;
      width: 80px;
     
    }
    
    .footer {
      margin-top: 20px;
    }
    
    .popup-btn {
      width: 100%;
      padding: 8px;
      font-size: 13px !important;
    }
    </style>
    
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              <div class="body-content d-flex flex-column align-items-center">
                <img src="{{ asset('images/trash.png') }}" class="img-fluid" alt="trash">
                <h6 class="mt-3">Are you sure you want to delete this record?</h6>
                <p class="text-muted" id="data-text"></p>
                <input type="hidden" name="data-table" id="data-table"> 
              </div>
              <div class="footer row">
                <div class="col-6">
                  <button type="button" class="btn btn-outline-secondary popup-btn" data-dismiss="modal">Cancel</button>
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-danger popup-btn">Delete</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    