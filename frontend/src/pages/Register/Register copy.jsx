import React, { useState } from "react";
import "./Register.css";
import logo from "../../assets/logo.png";
import registerationValidation from "./registrationValidation";
import { Link } from "react-router";
import axiosClient from "../../api/axiosClient";
const Register = () => {
  const initialValues = { username: "", email: "", phone: "" };
  const [input, setInput] = useState(initialValues);
  const [errors, setErrors] = useState({});
  const handleInput = (e) => {
    const { name, value } = e.target;
    setInput({ ...input, [name]: value });
    setErrors({ ...errors, [name]: "" });
  };
  const handleSubmit = async (e) => {
    e.preventDefault();
    const validation = registerationValidation(input);
    if (!validation.status) {
      setErrors(validation.errors);
    } else {
      try {
        const payload = { name: input.username, email: input.email, phone_number: input.phone };
        const response = await axiosClient.post("register", payload);
        if (response.status === 201) {
          alert("success");
        }
      } catch (error) {
        if (error.response.status === 422) {
          const validationErrors = error.response.data.errors;
          setErrors({
            ...errors,
            email: validationErrors.email ? validationErrors.email[0] : "",
            phone: validationErrors.phone_number ? validationErrors.phone_number[0] : "",
          });
        } else {
          alert(error.response.data.message);
        }
      }
    }
  };
  return (
    <section className="register-wrapper">
      <div className="register-container p-4">
        <div className="register-header mx-auto mb-4">
          <Link to="/">
            <img src={logo} alt="logo" width="50" height="50" className="d-inline-block align-text-center" />
            Book Store
          </Link>
        </div>
        <div className="register-body">
          <h5 className="mb-2">Signup</h5>
          <form onSubmit={handleSubmit} className="needs-validation" noValidate>
            <p className="mb-3">Please enter your contact details to Sign up</p>
            <div className="form-group mb-3">
              <input
                type="text"
                name="username"
                className={`form-control ${errors.username ? "is-invalid" : ""}`}
                id="username"
                placeholder="Name"
                value={input.username}
                onChange={handleInput}
              />
              <span className="invalid-feedback">{errors.username ? errors.username : ""}</span>
            </div>
            <div className="form-group mb-3">
              <input
                type="email"
                name="email"
                className={`form-control ${errors.email ? "is-invalid" : ""}`}
                id="email"
                placeholder="Email"
                value={input.email}
                onChange={handleInput}
              />
              <span className="invalid-feedback">{errors.email ? errors.email : ""}</span>
            </div>
            <div className="form-group mb-3">
              <input
                type="number"
                name="phone"
                className={`form-control ${errors.phone ? "is-invalid" : ""}`}
                id="phone"
                placeholder="Phone number"
                maxLength={10}
                minLength={10}
                value={input.phone}
                onChange={handleInput}
              />
              <span className="invalid-feedback">{errors.phone ? errors.phone : ""}</span>
            </div>
            <button className="btn btn-primary register-btn">Register</button>
          </form>
        </div>
      </div>
    </section>
  );
};

export default Register;
