import React from "react";
import Banner from "../../components/home/Banner/Banner";
import Category from "../../components/home/Category/Category";
import ProductList from "../../components/home/Products/ProductList";
import requests from "../../api/requests.js";
import banner from "../../assets/banner.jpg";
import banner2 from "../../assets/banner2.jpeg";

const Home = () => {
  return (
    <>
      <Banner banner={banner} />
      <Category />
      <ProductList title="New Arrival" fetchUrl={requests.fetchNewArrival} wrapperClass="container my-5" />
      {/* <ProductList title="Best Seller" fetchUrl={requests.fetchBestSeller} wrapperClass="container my-5" /> */}

      <Banner banner={banner2} />

      {/* <ProductList title="Fiction" fetchUrl={requests.fetchFictions} wrapperClass="container my-5" />
      <ProductList title="Non Fiction" fetchUrl={requests.fetchNonFictions} wrapperClass="container my-5" /> */}
    </>
  );
};

export default Home;
