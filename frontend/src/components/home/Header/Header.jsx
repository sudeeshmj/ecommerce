import React from "react";
import logo from "../../../assets/logo.png";
import "./Header.css";
import { FaUser } from "react-icons/fa";
import { FaHeart } from "react-icons/fa";
import { FaShoppingCart } from "react-icons/fa";
import { Link } from "react-router";
import { useSelector } from "react-redux";
import { FiUser } from "react-icons/fi";
import { BsBoxSeam } from "react-icons/bs";
import { HiOutlineHome } from "react-icons/hi";
const Header = () => {
  const { cartList } = useSelector((state) => state.cart);
  const { userInfo } = useSelector((state) => state.user);
  return (
    <nav className="navbar navbar-light">
      <div className="container d-flex justify-content-between align-items-center">
        {/* Left: Logo and Brand Name */}
        <Link className="navbar-brand d-flex align-items-center" href="/">
          <img src={logo} alt="logo" width="50" height="50" className="d-inline-block align-text-center" />
          <span className="logo-name">BookStore</span>
        </Link>

        {/* Center: Search Input */}
        <div className="search-container">
          <form>
            <input className="form-control" type="search" placeholder="Search" aria-label="Search" />
          </form>
        </div>

        {/* Right: Links */}
        <ul className="nav-items d-flex align-items-center">
          {Object.keys(userInfo).length === 0 ? (
            <li className="nav-item">
              <Link to="/login">
                <FaUser />
              </Link>
            </li>
          ) : (
            <li className="nav-item ">
              <Link
                to="/login"
                className="dropdown-toggle"
                id="navbarScrollingDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <FaUser />
                <span className="ms-2">Sudeesh M J</span>
              </Link>
              <ul class="dropdown-menu login-dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li className="dropdown">
                  <Link class="dropdown-item">
                    <FiUser className="me-2" /> My Profile
                  </Link>
                </li>
                <li className="dropdown">
                  <Link class="dropdown-item">
                    <BsBoxSeam className="me-2" /> My Orders
                  </Link>
                </li>

                <li className="dropdown">
                  <Link class="dropdown-item">
                    <HiOutlineHome className="me-2" />
                    My Address
                  </Link>
                </li>
                <li className="dropdown">
                  <Link class="dropdown-item logout-container">
                    <button className="logout-btn text-center">Logout</button>
                  </Link>
                </li>
              </ul>
            </li>
          )}

          <li className="nav-item">
            <Link to="/login">
              <FaHeart />
            </Link>
          </li>

          <li className="nav-item position-relative">
            <Link to="/cart">
              <FaShoppingCart />
              {cartList.length > 0 && (
                <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {cartList.length}
                </span>
              )}
            </Link>
          </li>
        </ul>
      </div>
    </nav>
  );
};

export default Header;
