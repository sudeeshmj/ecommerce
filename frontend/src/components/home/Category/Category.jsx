import React from "react";
import "./Category.css";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/pagination";
const categories = [
  {
    id: 1,
    name: "Fiction",
  },
  {
    id: 1,
    name: "NonFiction",
  },
  {
    id: 1,
    name: "Thriller",
  },
  {
    id: 1,
    name: "Romance",
  },
  {
    id: 1,
    name: "Advanture",
  },
  {
    id: 1,
    name: "Advanture",
  },
  {
    id: 1,
    name: "Advanture",
  },
  {
    id: 1,
    name: "Advanture",
  },
  {
    id: 1,
    name: "Advanture",
  },
];

const Category = () => {
  return (
    <section className="container mt-4">
      <div className="row">
        <Swiper
          slidesPerView={5} // Display 3 slides at a time
          pagination={{ clickable: true }}
          spaceBetween={25}
        >
          {categories.map((category) => (
            <SwiperSlide key={category.id}>
              <div className="card category-card">
                <h6 className="category-name">{category.name}</h6>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  );
};

export default Category;
