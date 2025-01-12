import React from "react";
import { CiEdit } from "react-icons/ci";
const DeliveryAddressItem = () => {
  return (
    <div className="address px-5 my-3 d-flex justify-content-between">
      <div className="address-data">
        <h6>Test</h6>
        <span>test, test, test, test, KERALA - 680681</span>
        <p className="mt-1">7487478777</p>
      </div>
      <div>
        <button className="address-edit-btn">
          <CiEdit />
        </button>
      </div>
    </div>
  );
};

export default DeliveryAddressItem;
