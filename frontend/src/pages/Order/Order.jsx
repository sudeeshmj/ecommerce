import React from "react";
import "./order.css";
import DeliveryAddress from "../../components/Order/DeliveryAddress/DeliveryAddress";

const Order = () => {
  return (
    <section className="order-product-section">
      <div className="container">
        <div className="row">
          <div className="col-md-8">
            <DeliveryAddress />
          </div>
          <div className="col-md-4">
            <div className="price-section mt-4 pt-0 p-4">
              <h6>Price Details (2 items)</h6>
              <hr />
              <div className="d-flex justify-content-between text-muted my-3">
                <h6 className="price-key">Total Price (2 items)</h6>
                <h6 className="price-key">₹995</h6>
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
                <h6 className="total-price-key">₹ 783</h6>
              </div>
              <div className="">
                <button className="continue-btn">Continue</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Order;
