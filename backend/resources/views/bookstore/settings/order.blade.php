<div class="tab-pane fade" id="v-pills-order" role="tabpanel" >
    <h6><u>Delivery Charge</u></h6>
    <div class="form-group mb-3">
        <label for="store_name" class="col-form-label">Minimum Order for Free Delivery:</label>
        <input type="text" class='form-control @error("store_name") is-invalid @enderror' id="store_name"  value={{ $storeInfo->store_name }} name="store_name"  required>
        @error('store_name')
        <div class="invalid-feedback">{{ $message  }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="store_name" class="col-form-label">Delivery Charges Below Minimum Order:</label>
        <input type="text" class='form-control @error("store_name") is-invalid @enderror' id="store_name"  value={{ $storeInfo->store_name }} name="store_name"  required>
        @error('store_name')
        <div class="invalid-feedback">{{ $message  }}</div>
        @enderror
    </div>
</div>