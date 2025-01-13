import p1_img from "./product_1.jpg";
import p2_img from "./product_2.jpg";
import p3_img from "./product_3.jpg";
import p4_img from "./product_4.jpg";

let data_product = [
  {
    id: 1,
    name: "Atomic Habits: An Easy And Proven Way To Build Good Habits And Break Bad Ones",
    image: p2_img,
    new_price: 50.0,
    old_price: 80.5,
    discount: 20,
    language: "Malayalam",
    author: "James Clear",
    binding: "paperback",
    isbn: "9789362541277",
    publishing_date: "29-08-2024",
    publisher: "DC BOOKS",
    edition: 1,
    number_of_pages: "240",
  },
  {
    id: 2,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p2_img,
    new_price: 85.0,
    old_price: 120.5,
    discount: 20,
  },
  {
    id: 3,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p3_img,
    new_price: 60.0,
    old_price: 100.5,
    discount: 20,
  },
  {
    id: 4,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p4_img,
    new_price: 100.0,
    old_price: 150.0,
    discount: 20,
  },
  {
    id: 5,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p4_img,
    new_price: 100.0,
    old_price: 150.0,
    discount: 20,
  },
  {
    id: 6,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p4_img,
    new_price: 100.0,
    old_price: 150.0,
  },
  {
    id: 7,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p4_img,
    new_price: 100.0,
    old_price: 150.0,
  },
  {
    id: 8,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p4_img,
    new_price: 100.0,
    old_price: 150.0,
  },
  {
    id: 9,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p4_img,
    new_price: 100.0,
    old_price: 150.0,
  },
  {
    id: 10,
    name: "Striped Flutter Sleeve Overlap Collar Peplum Hem Blouse",
    image: p4_img,
    new_price: 100.0,
    old_price: 150.0,
  },
];

export default data_product;

export const sub_header = [
  {
    id: 1,
    title: "Category",
    dropdown: "yes",
    submenus: [
      {
        id: 1,
        title: "Fiction",
      },
      {
        id: 2,
        title: "Non Fiction",
      },
      {
        id: 3,
        title: "Romance",
      },
      {
        id: 4,
        title: "Self Help",
      },
    ],
  },

  {
    id: 2,
    title: "Language",
    dropdown: "yes",
    submenus: [
      {
        id: 1,
        title: "English",
      },
      {
        id: 2,
        title: "Malayalam",
      },
      {
        id: 3,
        title: "Tamil",
      },
      {
        id: 4,
        title: "Hindi",
      },
    ],
  },

  {
    id: 3,
    title: "Best Seller",
    dropdown: "no",
  },
  {
    id: 4,
    title: "Award Winners",
    dropdown: "no",
  },
  {
    id: 5,
    title: "Children",
    dropdown: "no",
  },
];
