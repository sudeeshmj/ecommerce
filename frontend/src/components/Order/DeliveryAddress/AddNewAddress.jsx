import React, { useEffect, useState } from "react";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import addressValidation from "./addressValidation";
import axiosClient from "../../../api/axiosClient";
import toast from "react-hot-toast";
import { useSelector } from "react-redux";
const NewAddressBtn = ({ updateDeliveryAddressList, show, setShow, modalMode, setModalMode, address }) => {
  const { userInfo } = useSelector((state) => state.user);
  const initialValues = {
    customerId: userInfo.id,
    customerName: "",
    phone: "",
    pincode: "",
    locality: "",
    address: "",
    city: "",
    state: "",
    landmark: "",
    addType: "1",
    defaultAddress: false,
  };
  const [input, setInput] = useState(initialValues);
  const [errors, setErrors] = useState({});

  const handleInput = (e) => {
    const { name, value } = e.target;

    setInput({ ...input, [name]: value });
    setErrors({ ...errors, [name]: "" });
  };

  const handleClose = () => {
    setShow(false);
    setInput(initialValues);
    setErrors({});
    setModalMode("add");
  };

  const handleShow = () => setShow(true);

  const handleSubmit = async (e) => {
    e.preventDefault();

    const validation = addressValidation(input);
    if (!validation.status) {
      setErrors(validation.errors);
    } else {
      const payload = {
        customer_id: input.customerId,
        name: input.customerName,
        phone_number: input.phone,
        pincode: input.pincode,
        locality: input.locality,
        address: input.address,
        city: input.city,
        state_id: input.state,
        landmark: input.landmark,
        address_type: input.addType,
        default_address: input.defaultAddress === true ? 1 : 0,
      };
      try {
        let response;
        if (modalMode === "edit") {
          response = await axiosClient.put(`delivery-addresses/${address.id}`, payload, {
            headers: { Authorization: `Bearer ${userInfo.token}` },
          });
        } else {
          response = await axiosClient.post("delivery-addresses", payload, {
            headers: {
              Authorization: `Bearer ${userInfo.token}`, // Headers
            },
          });
        }

        if (response.status === 201 || response.status === 200) {
          toast(response.data.message, {
            icon: "✔",
            style: {
              borderRadius: "0.375rem",
              background: "#000",
              color: "#fff",
            },
          });
          updateDeliveryAddressList(response.data.data);
          handleClose();
        }
      } catch (error) {
        if (error.response.status === 422) {
          const validationErrors = error.response.data.errors;
          setErrors({
            ...errors,
            customerName: validationErrors.name ? validationErrors.name[0] : "",
            phone: validationErrors.phone_number ? validationErrors.phone_number[0] : "",
            state: validationErrors.state_id ? validationErrors.state_id[0] : "",
          });
        } else {
          toast.error(error.response.data.message);
        }
      }
    }
  };

  function isNumbercheck(event) {
    var input = event.target.value;
    var sanitizedInput = input.replace(/[^0-9]/g, "");
    event.target.value = sanitizedInput;
  }
  // Prepopulate form for editing
  useEffect(() => {
    if (modalMode === "edit" && address) {
      setInput({
        customerId: address.customer_id,
        customerName: address.name,
        phone: address.phone_number,
        addressType: address.address_type,
        address: address.address,
        city: address.city,
        state: address.state_id,
        pincode: address.pincode,
        locality: address.locality,
        landmark: address.landmark ?? "",
        addType: address.address_type,
        defaultAddress: address.default_address,
      });
    } else {
      setInput(initialValues);
    }
  }, [modalMode, address]);

  return (
    <>
      <div className="add-new-address" onClick={handleShow}>
        <span>+ Add New Address</span>
      </div>
      <Modal show={show} onHide={handleClose} animation={false}>
        <form onSubmit={handleSubmit} className="needs-validation" noValidate>
          <Modal.Header closeButton>
            <Modal.Title> {modalMode === "edit" ? "Edit Address" : "Add New Address"}</Modal.Title>
          </Modal.Header>
          <Modal.Body>
            <div className="row mb-3">
              <div className="col">
                <input
                  required="required"
                  type="text"
                  name="customerName"
                  className={`form-control address-form-input ${errors.customerName ? "is-invalid" : ""}`}
                  id="customerName"
                  placeholder="Name"
                  maxLength="190"
                  value={input.customerName}
                  onChange={handleInput}
                />
                <span className="invalid-feedback">{errors.customerName ? errors.customerName : ""}</span>
              </div>
              <div className="col">
                <input
                  type="tel"
                  name="phone"
                  className={`form-control address-form-input ${errors.phone ? "is-invalid" : ""}`}
                  id="phone"
                  placeholder="10 digit mobile number"
                  maxLength="10"
                  onInput={isNumbercheck}
                  value={input.phone}
                  onChange={handleInput}
                  autoComplete="off"
                />
                <span className="invalid-feedback">{errors.phone ? errors.phone : ""}</span>
              </div>
            </div>
            <div className="row mb-3">
              <div className="col">
                <input
                  type="text"
                  className={`form-control address-form-input ${errors.pincode ? "is-invalid" : ""}`}
                  placeholder="Pincode"
                  id="pincode"
                  name="pincode"
                  maxLength="6"
                  onInput={isNumbercheck}
                  value={input.pincode}
                  onChange={handleInput}
                  autoComplete="off"
                />
                <span className="invalid-feedback">{errors.pincode ? errors.pincode : ""}</span>
              </div>
              <div className="col">
                <input
                  type="text"
                  className={`form-control address-form-input ${errors.locality ? "is-invalid" : ""}`}
                  placeholder="Locality"
                  name="locality"
                  id="locality"
                  maxLength="190"
                  value={input.locality}
                  onChange={handleInput}
                />
                <span className="invalid-feedback">{errors.locality ? errors.locality : ""}</span>
              </div>
            </div>
            <div className="row mb-3">
              <div className="col">
                <textarea
                  name="address"
                  className={`form-control address-form-input ${errors.address ? "is-invalid" : ""}`}
                  placeholder="Address"
                  id="address"
                  maxLength="190"
                  onChange={handleInput}
                  value={input.address}
                ></textarea>
                <span className="invalid-feedback">{errors.address ? errors.address : ""}</span>
              </div>
            </div>

            <div className="row mb-3">
              <div className="col">
                <input
                  type="text"
                  className={`form-control address-form-input ${errors.city ? "is-invalid" : ""}`}
                  placeholder="City"
                  name="city"
                  id="city"
                  maxLength="190"
                  value={input.city}
                  onChange={handleInput}
                />
                <span className="invalid-feedback">{errors.city ? errors.city : ""}</span>
              </div>
              <div className="col">
                <select
                  name="state"
                  id="state"
                  className={`form-control address-form-input ${errors.state ? "is-invalid" : ""}`}
                  onChange={handleInput}
                  value={input.state}
                >
                  <option value="" disabled>
                    --Select State--
                  </option>
                  <option value="1">Kerala</option>
                </select>
                <span className="invalid-feedback">{errors.state ? errors.state : ""}</span>
              </div>
            </div>
            <div className="row mb-4">
              <div className="col">
                <input
                  type="text"
                  className={`form-control address-form-input ${errors.landmark ? "is-invalid" : ""}`}
                  placeholder="Landmark"
                  name="landmark"
                  id="landmark"
                  maxLength="190"
                  value={input.landmark}
                  onChange={handleInput}
                />
                <span className="invalid-feedback">{errors.landmark ? errors.landmark : ""}</span>
              </div>
              <div className="col  d-flex align-items-center">
                <div className="form-check form-check-inline">
                  <input
                    className={`form-check-input ${errors.addType ? "is-invalid" : ""}`}
                    type="radio"
                    name="addType"
                    id="addType1"
                    value="1"
                    checked={input.addType == "1"}
                    onChange={handleInput}
                  />
                  <label className="form-check-label" htmlFor="addType1">
                    Home
                  </label>
                </div>
                <div className="form-check form-check-inline">
                  <input
                    className={`form-check-input ${errors.addType ? "is-invalid" : ""}`}
                    type="radio"
                    name="addType"
                    id="addType2"
                    value="2"
                    onChange={handleInput}
                    checked={input.addType == "2"}
                  />
                  <label className="form-check-label" htmlFor="addType2">
                    Company
                  </label>
                </div>
                <span className="invalid-feedback">{errors.addType ? errors.addType : ""}</span>
              </div>
            </div>
            <div className="row">
              <div className="col">
                <div className="form-check form-switch">
                  <input
                    className="form-check-input"
                    type="checkbox"
                    onChange={(e) => {
                      setInput({ ...input, [e.target.name]: e.target.checked });
                    }}
                    name="defaultAddress"
                    id="defaultAddress"
                    checked={input.defaultAddress}
                  />
                  <label className="form-check-label" htmlFor="defaultAddress">
                    Use as default address
                  </label>
                </div>
              </div>
            </div>
          </Modal.Body>
          <Modal.Footer className="mb-3">
            <Button type="submit" variant="primary w-100 continue-btn">
              Save Changes
            </Button>
          </Modal.Footer>
        </form>
      </Modal>
    </>
  );
};

export default NewAddressBtn;
