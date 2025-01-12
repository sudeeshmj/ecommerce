import React from "react";
import { useSelector, useDispatch } from "react-redux";
import { addToCart } from "../../redux/cartSlice";
import requests from "../../api/requests.js";
import { useNavigate } from "react-router-dom";

const ProductInfo = ({ productData }) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const { cartList } = useSelector((state) => state.cart);

  let btnName = "Add To Cart";
  const item = cartList.find((item) => item.id === productData.id);
  if (item) {
    btnName = "Go To Cart";
  }
  const handleCartNavigation = () => {
    if (item) {
      navigate("/cart");
    } else {
      dispatch(addToCart(productData));
    }
  };

  return (
    <div className="product-info-container">
      <div className="row d-flex justify-content-between">
        <div className="col-md-4 d-flex justify-content-center">
          <div className="product-image">
            <img src={`${requests.imageUrl}${productData.image}`} alt="product_img" />
          </div>
        </div>
        <div className="col-md-6">
          <div className="product-info">
            <h4>{productData.title}</h4>
            <p>
              <span className="author">
                Author : <strong>{productData.author.name}</strong>{" "}
              </span>
              <span className="language">Language : {productData.language.language_name}</span>
            </p>
            <div className="product-price">
              <span>${productData.offer_price}</span>
              <del>${productData.price}</del>
              <code>30% OFF</code>
            </div>

            <ul className="more-info my-2 p-3">
              <li>ISBN:{productData.isbn}</li>
              <li>Publishing_Date:{productData.publishing_date}</li>
              <li>Publisher:{productData.publisher.name}</li>
              <li>Number of Pages:{productData.pages}</li>
            </ul>

            <div className="order-section">
              <button className="cart-btn" onClick={() => handleCartNavigation()}>
                {btnName}
              </button>
              <button className="buy-btn">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProductInfo;
