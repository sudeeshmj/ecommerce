import React, { useState } from "react";
import "./order.css";
import DeliveryAddress from "../../components/Order/DeliveryAddress/DeliveryAddress";
import { useSelector } from "react-redux";

const Order = () => {
  const { cartList } = useSelector((state) => state.cart);
  const [selectedAddress, setSelectedAddress] = useState({});
  const totalPrice = cartList.reduce((acc, item) => acc + item.price * item.count, 0);
  const totalOfferPrice = cartList.reduce((acc, item) => acc + item.offer_price * item.count, 0);
  const itemCount = cartList.length > 1 ? `${cartList.length} items` : `${cartList.length} item`;

  const handleOrderSubmit = () => {};
  return (
    <section className="order-product-section">
      <div className="container">
        <div className="row">
          <div className="col-md-8">
            <DeliveryAddress selectedAddress={selectedAddress} setSelectedAddress={setSelectedAddress} />
          </div>
          <div className="col-md-4">
            <div className="price-section mt-4 pt-0 p-4">
              <h6>Price Details ({itemCount})</h6>
              <hr />
              <div className="d-flex justify-content-between text-muted my-3">
                <h6 className="price-key">Total Price</h6>
                <h6 className="price-key">₹{totalPrice}</h6>
              </div>
              <div className="d-flex justify-content-between text-muted my-3">
                <h6 className="price-key">Delivery Charges</h6>
                <h6 className="price-key" style={{ color: "#54ad54" }}>
                  Free Delivery
                </h6>
              </div>
              <hr />
              <div className="d-flex justify-content-between my-2">
                <h6 className="total-price-key">Total Payable Amount</h6>
                <h6 className="total-price-key">₹{totalOfferPrice}</h6>
              </div>
              <div className="">
                <button className="continue-btn" onClick={handleOrderSubmit}>
                  Continue
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Order;
