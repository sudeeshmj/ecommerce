import React, { useEffect, useState } from "react";
import toast from "react-hot-toast";
import axiosClient from "../../api/axiosClient";
import { useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { login } from "../../redux/userSlice";

const OTPVerification = ({ phoneNumber }) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const [counter, setCounter] = useState(30);
  const initialValues = { phone_number: phoneNumber, otp: "" };
  const [input, setInput] = useState(initialValues);
  const [error, setError] = useState("");
  useEffect(() => {
    let timer;
    if (counter > 0) {
      timer = setInterval(() => {
        setCounter((prev) => prev - 1);
      }, 1000);
    }
    return () => clearInterval(timer);
  }, [counter]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (otp !== null) {
      try {
        const response = await axiosClient.post("otp-verify", input);
        if (response.status === 200) {
          //save user data in redux toolkit
          dispatch(login(response.data.data));
          toast(`Registration Successfull`, {
            icon: "✔",
            style: {
              borderRadius: "0.375rem",
              background: "#000",
              color: "#fff",
            },
          });
          navigate("/");
        }
      } catch (error) {
        if (error.response.data.errors && error.response.data.errors.otp) {
          setError(error.response.data.errors.otp[0]);
        } else {
          setError(error.response.data.message);
        }
      }
    }
  };

  const handleInput = (e) => {
    const { name, value } = e.target;
    setInput({ ...input, [name]: value });
    setError("");
  };

  const handleResend = (e) => {
    e.preventDefault();
    //api call for otp resend
    toast(`verification code send to ${phoneNumber}`, {
      icon: "✔",
      style: {
        borderRadius: "0.375rem",
        background: "#000",
        color: "#fff",
      },
    });
    setCounter(30);
  };

  return (
    <div className="otpverifcation-container">
      <form onSubmit={handleSubmit} className="needs-validation" noValidate>
        <p className="mb-3 text-center">
          Please enter OTP send to
          <br />
          {phoneNumber}
        </p>
        <div className="form-group mb-3">
          <input
            required
            type="text"
            name="otp"
            className={`form-control ${error ? "is-invalid" : ""}`}
            id="otp"
            placeholder="OTP"
            maxLength="4"
            value={input.otp}
            onChange={handleInput}
          />
          <span className="invalid-feedback">{error}</span>
        </div>
        <button className="btn btn-primary register-btn">Verify</button>
        <p className="text-center text-mute">
          Not received your code?
          {counter === 0 ? (
            <button className="otp-resend-btn" onClick={handleResend}>
              Resend
            </button>
          ) : (
            `00:${counter.toString().padStart(2, "0")}`
          )}
        </p>
      </form>
    </div>
  );
};

export default OTPVerification;
