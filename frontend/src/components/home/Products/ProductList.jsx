import React, { useEffect, useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/pagination";
import ProductItem from "./ProductItem";
import "./ProductList.css";
import { Link } from "react-router-dom";
import axiosClient from "../../../api/axiosClient";

const ProductList = ({ title, fetchUrl, wrapperClass = "" }) => {
  const [books, setBooks] = useState([]);

  useEffect(() => {
    async function fetchData() {
      const response = await axiosClient.get(fetchUrl);
      setBooks(response.data.data);
    }
    if (fetchUrl) {
      fetchData();
    }
  }, []);

  return (
    <section className={wrapperClass}>
      <div className="row">
        <div className="item-list-header d-flex justify-content-between align-items-center">
          <h2>{title}</h2>
          <a href="">View All</a>
        </div>
        <div className="my-1">
          <Swiper
            slidesPerView={5} // Display 3 slides at a time
            pagination={{ clickable: true }}
            spaceBetween={25}
          >
            {books.map((itemData) => (
              <SwiperSlide key={`${title}-${itemData.id}`}>
                <Link to={`/product/${itemData.id}`}>
                  <ProductItem items={itemData} />
                </Link>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>
      </div>
    </section>
  );
};

export default ProductList;
