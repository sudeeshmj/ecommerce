import React, { useState } from "react";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
const NewAddressBtn = () => {
  const [show, setShow] = useState(false);

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);
  return (
    <>
      <div className="add-new-address" onClick={handleShow}>
        <span>+ Add New Address</span>
      </div>
      <Modal show={show} onHide={handleClose} animation={false}>
        <Modal.Header closeButton>
          <Modal.Title>Add New Address</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <div className="row mb-3">
            <div className="col">
              <input type="text" className="form-control address-form-input" placeholder="Name" />
            </div>
            <div className="col">
              <input type="text" className="form-control address-form-input" placeholder="10 digit mobile number" />
            </div>
          </div>
          <div className="row mb-3">
            <div className="col">
              <input type="text" className="form-control address-form-input" placeholder="Pincode" />
            </div>
            <div className="col">
              <input type="text" className="form-control address-form-input" placeholder="Locality" />
            </div>
          </div>
          <div className="row mb-4">
            <div className="col">
              <textarea name="" className="form-control address-form-input" placeholder="Address" id=""></textarea>
            </div>
          </div>

          <div className="row mb-4">
            <div className="col">
              <input type="text" className="form-control address-form-input" placeholder="City" />
            </div>
            <div className="col">
              <input type="text" className="form-control address-form-input" placeholder="State" />
            </div>
          </div>
          <div className="row">
            <div className="col">
              <input type="text" className="form-control address-form-input" placeholder="Landmark" />
            </div>
            <div className="col"></div>
          </div>
        </Modal.Body>
        <Modal.Footer className="mb-3">
          <Button variant="primary w-100 continue-btn" onClick={handleClose}>
            Save Changes
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  );
};

export default NewAddressBtn;
