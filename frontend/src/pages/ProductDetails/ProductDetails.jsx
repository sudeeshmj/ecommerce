import React, { useState, useEffect } from "react";
import "./ProductDetails.css";
import ProductInfo from "../../components/ProductDetails/ProductInfo";
import ProductAbout from "../../components/ProductDetails/ProductAbout";
import SimilarProducts from "../../components/ProductDetails/SimilarProducts";
import { useParams } from "react-router-dom";
import axiosClient from "../../api/axiosClient";

const ProductDetails = () => {
  const { id } = useParams();
  const [productData, setProductData] = useState(null);
  useEffect(() => {
    if (id) {
      const fetchProductData = async () => {
        try {
          const response = await axiosClient.get(`book/${id}`);

          setProductData(response.data.data);
        } catch (err) {
          console.error("Error fetching product data:", err);
        } finally {
        }
      };
      fetchProductData();
    }
  }, []);

  return (
    <div className="product-details-wrapper">
      {productData && <ProductInfo productData={productData} />}
      {productData && <ProductAbout productData={productData} />}
      <SimilarProducts />
    </div>
  );
};

export default ProductDetails;
