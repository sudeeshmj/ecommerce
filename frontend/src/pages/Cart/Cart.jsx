import React from "react";
import "./cart.css";
import CartItem from "../../components/Cart/CartItem";
import { useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
const Cart = () => {
  const navigate = useNavigate();
  const { cartList } = useSelector((state) => state.cart);

  const totalPrice = cartList.reduce((acc, item) => acc + item.price * item.count, 0);
  const totalOfferPrice = cartList.reduce((acc, item) => acc + item.offer_price * item.count, 0);
  const discount = totalPrice - totalOfferPrice;

  return (
    <div className="cart-section">
      <div className="container py-3 pt-4">
        <div className="row">
          {cartList.length > 0 ? (
            <>
              <div className="col-md-8">
                {cartList.map((item) => (
                  <CartItem key={item.id} cartItem={item} />
                ))}
              </div>
              <div className="col-md-4">
                <div className="product-price-section p-4">
                  <h5 className="title text-muted">price details</h5>
                  <hr />
                  <div className="price price-display-flex my-3">
                    <h6>Price ({cartList.length})</h6>
                    <h6>₹{totalPrice}</h6>
                  </div>
                  <div className="price price-display-flex my-3">
                    <h6>Discount</h6>
                    <h6 style={{ color: "#54ad54" }}>-₹{discount}</h6>
                  </div>
                  <div className="price price-display-flex my-3">
                    <h6>Delivery Charges</h6>
                    <h6 style={{ color: "#54ad54" }}>Free</h6>
                  </div>
                  <hr />
                  <div className="price total-amount price-display-flex my-3">
                    <h6>Total Amount</h6>
                    <h6>₹{totalOfferPrice}</h6>
                  </div>
                  <div className="">
                    <button
                      onClick={() => navigate("/order")}
                      className="place-order-btn d-flex justify-content-around align-items-center"
                    >
                      <span>Proceed to Checkout</span>
                    </button>
                  </div>
                </div>
              </div>
            </>
          ) : (
            <div>No Item </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default Cart;
