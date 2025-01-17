import React from "react";
import data_product from "../../assets/data";
import ProductList from "../../components/home/Products/ProductList";
const SimilarProducts = () => {
  return (
    <>
      <div className="similar-products-container">
        <ProductList title="Best Seller" data_product={data_product} />
      </div>
      <div className="author-products-container">
        <ProductList title="Best Seller" data_product={data_product} />
      </div>
	  <div></div>
    </>
  );
};

export default SimilarProducts;
