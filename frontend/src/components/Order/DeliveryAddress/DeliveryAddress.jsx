import React, { useEffect, useState } from "react";
import AddNewAddress from "./AddNewAddress";
import DeliveryAddressItem from "./DeliveryAddressItem";
import "./DeliveryAddress.css";
import axiosClient from "../../../api/axiosClient";
import toast from "react-hot-toast";
import { useSelector } from "react-redux";

const DeliveryAddress = () => {
  const { userInfo } = useSelector((state) => state.user);
  const [deliveryAddresses, setDeliveryAddresses] = useState([]);
  const [selectedAddressId, setSelectedAddressId] = useState(null);
  const [show, setShow] = useState(false);
  const [modalMode, setModalMode] = useState("add");
  const [selectedAddress, setSelectedAddress] = useState(null);

  const handleAddressChange = (addressId) => {
    setSelectedAddressId(addressId);
  };
  useEffect(() => {
    async function fetchDeliveryAddresses() {
      try {
        const response = await axiosClient.get("delivery-addresses", {
          params: { customer_id: userInfo.id },
          headers: { Authorization: `Bearer ${userInfo.token}` },
        });

        const addresses = response.data.data;
        setDeliveryAddresses(addresses);
        // Set the selected address if a default address is available
        const defaultAddress = addresses.find((address) => address.default_address === 1);
        setSelectedAddressId(defaultAddress?.id || null);
      } catch (error) {
        toast.error(error.response?.data?.message || "An error occurred");
      }
    }

    fetchDeliveryAddresses();
  }, []);

  const updateDeliveryAddressList = (address) => {
    setDeliveryAddresses((prevAddress) => {
      const isAddressExist = prevAddress.some((oldAddress) => oldAddress.id === address.id);
      if (isAddressExist) {
        return prevAddress.map((oldAddress) => (oldAddress.id === address.id ? address : oldAddress));
      } else {
        return [...deliveryAddresses, address];
      }
    });
  };

  //click from DelvieryAddressItem.jsx
  const handleEditClick = (e, address) => {
    e.stopPropagation();
    setShow(true);
    setModalMode("edit");
    setSelectedAddress(address);
  };
  return (
    <div className="address-section my-4">
      <h6>Delivery Address</h6>
      {deliveryAddresses.length > 0 &&
        deliveryAddresses.map((address) => (
          <DeliveryAddressItem
            key={address.id}
            address={address}
            isSelected={selectedAddressId === address.id}
            onAddressClick={handleAddressChange}
            onEdit={(e) => handleEditClick(e, address)}
          />
        ))}
      <AddNewAddress
        updateDeliveryAddressList={updateDeliveryAddressList}
        show={show}
        setShow={setShow}
        modalMode={modalMode}
        setModalMode={setModalMode}
        address={selectedAddress} //prefill data in editmode
      />
    </div>
  );
};

export default DeliveryAddress;
