import React, { useState } from "react";
import { CiEdit } from "react-icons/ci";
const DeliveryAddressItem = ({ address, isSelected, onAddressClick, onEdit }) => {
  const handleParentClick = () => {
    onAddressClick(address.id);
  };

  return (
    <div className="address px-5 my-3 d-flex align-items-center justify-content-between" onClick={handleParentClick}>
      <div className="radio-button">
        <input type="radio" name="address" id={`address-${address.id}`} checked={isSelected} readOnly />
      </div>
      <div className="address-data flex-grow-1 ms-3">
        <p className="mb-0">
          <span className="me-2">
            <b>{address.name}</b>
          </span>
          <span className="me-2">
            <b>{address.phone_number}</b>
          </span>
          <span className="delivery-address-type">{address.address_type == 1 ? "Home" : "Company"}</span>
        </p>
        <span className="delivery-address-2">
          {address.address}, {address.locality}, {address.city}, {address.state_name} - {address.pincode}
        </span>
      </div>
      <div className="edit-button">
        <button className="address-edit-btn" onClick={(e) => onEdit(e)}>
          <CiEdit />
        </button>
      </div>
    </div>
  );
};

export default DeliveryAddressItem;
