import React from "react";
import "./Login.css";
import logo from "../../assets/logo.png";
import { Link } from "react-router";
const Login = () => {
  return (
    <section className="login-wrapper">
      <div className="login-container p-4">
        <div className="login-header mx-auto mb-4">
          <Link to="/">
            <img src={logo} alt="logo" width="50" height="50" className="d-inline-block align-text-center" />
            Book Store
          </Link>
        </div>
        <div className="login-body">
          <h5 className="mb-2">Login</h5>
          <p className="mb-3">Please enter your mobile number</p>
          <input
            type="text "
            name="phone_number"
            className="form-control mb-3"
            id="phoner_number"
            placeholder="Phone number"
          />
          <button className="btn btn-primary login-btn">Login</button>
          <p className="text-mute text-center">
            Create an account? <Link to="/register">SignUp</Link>
          </p>
        </div>
      </div>
    </section>
  );
};

export default Login;
