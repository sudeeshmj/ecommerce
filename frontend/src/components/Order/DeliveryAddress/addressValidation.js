export default function addressValidation(input) {
  let errors = {};
  const phone_pattern = /^\d{10}$/;
  const pincode_pattern = /^\d{6}$/;
  var status = true;

  if (!input.customerName) {
    status = false;
    errors.customerName = "Please enter your name.";
  }

  if (!input.phone) {
    status = false;
    errors.phone = "Please enter your phone number.";
  }
  if (input.phone && !phone_pattern.test(input.phone)) {
    status = false;
    errors.phone = "Please enter 10 digit phone number";
  }

  if (!input.pincode) {
    status = false;
    errors.pincode = "Please enter your pincode.";
  }
  if (input.pincode && !pincode_pattern.test(input.pincode)) {
    status = false;
    errors.pincode = "Please enter a valid pincode.";
  }

  if (!input.locality) {
    status = false;
    errors.locality = "Please enter your locality.";
  }

  if (!input.address) {
    status = false;
    errors.address = "Please enter your address.";
  }

  if (!input.city) {
    status = false;
    errors.city = "Please enter your city.";
  }

  if (!input.state) {
    status = false;
    errors.state = "Please select your state.";
  }

  if (!input.addType) {
    alert(input.addType);
    status = false;
    errors.addType = "Please select address Type.";
  }
  return { errors: errors, status: status };
}
