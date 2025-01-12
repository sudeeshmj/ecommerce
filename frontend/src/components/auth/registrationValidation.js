export default function registerationValidation(input) {
  let errors = {};
  const email_pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const phone_pattern = /^\d{10}$/;
  var status = true;

  if (!input.username) {
    status = false;
    errors.username = "Please enter your name.";
  }
  if (!input.email) {
    status = false;
    errors.email = "Please enter your email address.";
  }

  if (input.email && !email_pattern.test(input.email)) {
    status = false;
    errors.email = "Please enter a valid email address.";
  }

  if (!input.phone) {
    status = false;
    errors.phone = "Please enter your phone number.";
  }

  if (input.phone && !phone_pattern.test(input.phone)) {
    status = false;
    errors.phone = "Please enter 10 digit phone number";
  }
  return { errors: errors, status: status };
}
