import React from "react";
import { RiDeleteBin6Line } from "react-icons/ri";
import { useDispatch } from "react-redux";
import { changeQuantity, removeCartItem } from "../../redux/cartSlice";
import requests from "../../api/requests.js";

const CartItem = ({ cartItem }) => {
  const dispatch = useDispatch();
  return (
    <>
      <div className="row mb-3">
        <div className="col-md-12">
          <div className="product-details p-3">
            <div className="row align-items-center gx-4">
              {/* Product Image */}
              <div className="col-3 col-md-2">
                <img src={`${requests.imageUrl}${cartItem.image}`} alt="Harry Potter" className="img-fluid" />
              </div>

              {/* Product Name and Price */}
              <div className="col-5 col-md-4">
                <div className="product-name-section">
                  <h5>{cartItem.title}</h5>
                  <p className="text-muted">₹{cartItem.offer_price}</p>
                </div>
              </div>

              {/* Quantity Input */}
              <div className="col-2 col-md-2">
                <select
                  className="form-select form-select-sm"
                  value={cartItem.count}
                  onChange={(e) => dispatch(changeQuantity({ id: cartItem.id, count: Number(e.target.value) }))}
                >
                  {Array.from({ length: 5 }, (_, i) => (
                    <option key={i + 1} value={i + 1}>
                      {i + 1}
                    </option>
                  ))}
                </select>
              </div>

              {/* Total Price */}
              <div className="col-3 col-md-2 text-end">
                <h5 className="text-primary product-total-price">₹{cartItem.offer_price * cartItem.count} </h5>
              </div>

              {/* Delete Button */}
              <div className="col-1 col-md-1 text-end">
                <a
                  href="#"
                  onClick={(e) => {
                    e.preventDefault();
                    dispatch(removeCartItem(cartItem.id));
                  }}
                  className="text-muted delete-icon"
                >
                  <RiDeleteBin6Line />
                </a>
              </div>
            </div>

            {/* Wishlist Link */}
            <div className="row mt-2">
              <div className="col-12">
                <a href="#" className="text-muted wishlist">
                  Move to Wishlist
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default CartItem;
