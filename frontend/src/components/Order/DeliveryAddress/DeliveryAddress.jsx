import React from "react";
import AddNewAddress from "./AddNewAddress";
import DeliveryAddressItem from "./DeliveryAddressItem";
import "./DeliveryAddress.css";

const DeliveryAddress = () => {
  return (
    <div className="address-section my-4">
      <h6>Delivery Address</h6>
      <DeliveryAddressItem />
      <AddNewAddress />
    </div>
  );
};

export default DeliveryAddress;
