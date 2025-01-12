import React, { useState } from "react";
import "./Register.css";
import logo from "../../assets/logo.png";
import { Link } from "react-router";
import Registration from "../../components/auth/Registration";
import OTPVerification from "../../components/auth/OTPVerification";
const Register = () => {
  const [registrationSuccess, setRegistrationSuccess] = useState(false);
  const [formData, setFormData] = useState({});
  console.log(formData);
  return (
    <section className="register-wrapper">
      <div className="register-container p-4">
        <div className="register-header mx-auto mb-4">
          <Link to="/">
            <img src={logo} alt="logo" width="50" height="50" className="d-inline-block align-text-center" />
            Book Store
          </Link>
        </div>
        {registrationSuccess ? (
          <OTPVerification phoneNumber={formData.phone_number} />
        ) : (
          <Registration setRegistrationSuccess={setRegistrationSuccess} setFormData={setFormData} />
        )}
      </div>
    </section>
  );
};

export default Register;
