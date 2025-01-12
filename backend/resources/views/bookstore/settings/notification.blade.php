<div class="tab-pane fade" id="v-pills-notification" role="tabpanel" >

  <form method="POST"  id="notification_settings_form" data-url="{{ route('settings.notification.store') }}"> 
    @csrf
    <fieldset class="form-group row mb-3" >
         <label  class="col-form-label col-sm-4 float-sm-left pt-0">Out of Stock :</label>
         <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                {{ isset($settings['out_of_stock_notify']) && $settings['out_of_stock_notify'] == '1' ? 'checked' : '' }}
                name="out_of_stock_notify" id="outofstock_enable" value="1" required>
                <label class="form-check-label" for="outofstock_enable">Enable</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"  
                {{ isset($settings['out_of_stock_notify']) && $settings['out_of_stock_notify'] == '0' ? 'checked' : '' }}
                name="out_of_stock_notify" id="outofstock_disable" value="0" required>
                <label class="form-check-label" for="outofstock_disable">Disable</label>
              </div>
         </div>
      </fieldset>
      <div class="form-group row mb-3">
        <label for="admin_email"  class=" col-sm-4 col-form-label">Email:</label>
        <input type="email" value="{{ $settings['out_of_stock_email'] ?? '' }}" class='form-control col-sm-8 @error("out_of_stock_email") is-invalid @enderror' value="" id="out_of_stock_email"   name="out_of_stock_email" required>
        @error('out_of_stock_email')
        <div class="invalid-feedback">{{ $message  }}</div>
        @enderror
      </div>
      <fieldset class="form-group row mb-3">
        <label  class="col-form-label col-sm-4 float-sm-left pt-0">Weekly Out of Stock Summary:</label>
        <div class="col-sm-8">
           <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" 
               {{ isset($settings['weekly_notify']) && $settings['weekly_notify'] == '1' ? 'checked' : '' }}
                name="weekly_notify" id="weekly_notify_enable" value="1" required>
               <label class="form-check-label" for="weekly_notify_enable">Enable</label>
             </div>
             <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio"
               {{ isset($settings['weekly_notify']) && $settings['weekly_notify'] == '0' ? 'checked' : '' }}
                name="weekly_notify" id="weekly_notify_disable" value="0" required>
               <label class="form-check-label" for="weekly_notify_disable">Disable</label>
             </div>
        </div>
     </fieldset>
     <div class="form-group row mb-3">
        <label for="notification_day" class="col-sm-4 col-form-label float-sm-left pt-0">Notification Day:</label>
        <div class="col-sm-8">
            <select class="form-control" id="weekly_notify_day" name="weekly_notify_day" required >
                <option value="" disabled selected>Select Day</option>
                <option  {{ isset($settings['weekly_notify_day']) && $settings['weekly_notify_day'] === 'Monday' ? 'selected':'' }}  value="Monday">Monday</option>
                <option {{ isset($settings['weekly_notify_day']) && $settings['weekly_notify_day'] === 'Tuesday' ? 'selected':'' }} value="Tuesday">Tuesday</option>
                <option {{ isset($settings['weekly_notify_day']) && $settings['weekly_notify_day'] === 'Wednesday' ? 'selected':'' }} value="Wednesday">Wednesday</option>
                <option {{ isset($settings['weekly_notify_day']) && $settings['weekly_notify_day'] === 'Thursday' ? 'selected':'' }} value="Thursday">Thursday</option>
                <option {{ isset($settings['weekly_notify_day']) && $settings['weekly_notify_day'] === 'Friday' ? 'selected':'' }} value="Friday">Friday</option>
                <option {{ isset($settings['weekly_notify_day']) && $settings['weekly_notify_day'] === 'Saturday' ? 'selected':'' }} value="Saturday">Saturday</option>
                <option {{ isset($settings['weekly_notify_day']) && $settings['weekly_notify_day'] === 'Sunday' ? 'selected':'' }} value="Sunday">Sunday</option>
            </select>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="weekly_notify_time" class="col-sm-4 col-form-label float-sm-left pt-0">Notification Time:</label>
        <div class="col-sm-8">
            <input type="time" class="form-control" id="weekly_notify_time" name="weekly_notify_time" value="{{ $settings['weekly_notify_time'] ?? '' }}" required>
        </div>
    </div>
    <div class="form-group mb-3 text-right">
      <button type="submit" class="btn  btn-primary btn-sm add_new_btn">Save</button>
    </div>
  </form>
</div>
<script type="text/javascript">

  
  $(document).ready(function() {   

      //form submission
      $("#notification_settings_form").submit(function(e){
          e.preventDefault();
         const data = new FormData(this);
         const routeUrl = $(this).data('url');

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