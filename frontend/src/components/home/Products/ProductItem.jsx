import React from "react";
import { FiShoppingCart } from "react-icons/fi";
import { FaRegHeart } from "react-icons/fa";
import { BsFillCartCheckFill } from "react-icons/bs";
import { addToCart, removeCartItem } from "../../../redux/cartSlice.js";
import requests from "../../../api/requests.js";
import { useDispatch, useSelector } from "react-redux";
import "./ProductItem.css";
const ProductItem = (props) => {
  const { cartList } = useSelector((state) => state.cart);
  const isInCart = cartList && cartList.find((item) => item.id === props.items.id);
  const dispatch = useDispatch();

  const toggleCart = (item) => {
    //check if the item is in cart if yes call remove  else addtocart
    const itemExist = cartList && cartList.find((item) => item.id === props.items.id);
    if (itemExist) {
      dispatch(removeCartItem(item.id));
    } else {
      dispatch(addToCart(item));
    }
  };
  return (
    <div className="product-item my-2">
      <div className="product-item-image">
        <img src={`${requests.imageUrl}${props.items.image}`} alt={props.items.title} />
        <div className="list-action d-flex flex-column">
          <div
            className="text-center action-text"
            onClick={(e) => {
              e.preventDefault();
              toggleCart(props.items);
            }}
          >
            {" "}
            {isInCart ? <BsFillCartCheckFill /> : <FiShoppingCart />}
          </div>
          <div className="text-center action-text">
            <FaRegHeart />
          </div>
        </div>
      </div>
      <div className="product-item-info">
        <h3>{props.items.title}</h3>
        <div className="product-price">
          <span>${props.items.offer_price}</span>
          {props.items.price && <del>${props.items.price}</del>}
          {props.items.discount_percentage && <code>{props.items.discount_percentage}% OFF</code>}
        </div>
      </div>
    </div>
  );
};

export default ProductItem;
