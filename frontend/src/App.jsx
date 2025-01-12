import {
  createBrowserRouter,
  RouterProvider,
  Outlet,
  createRoutesFromElements,
  Route,
  ScrollRestoration,
} from "react-router-dom";
import Header from "./components/home/Header/Header";
import Footer from "./components/home/Footer/Footer";
import Home from "./pages/Home/Home.jsx";
import ProductDetails from "./pages/ProductDetails/ProductDetails";
import Cart from "./pages/Cart/Cart.jsx";
import Order from "./pages/Order/Order.jsx";
import "./App.css";
import Login from "./pages/Login/Login.jsx";
import Register from "./pages/Register/Register.jsx";
import { Toaster } from "react-hot-toast";
import ProtectedRoute from "./utils/ProtectedRoute.jsx";
const Layout = () => (
  <>
    <Header />
    <ScrollRestoration />
    <Outlet />
    <Footer />
  </>
);

const router = createBrowserRouter(
  createRoutesFromElements(
    <Route>
      <Route path="/login" element={<Login />}></Route>
      <Route path="/register" element={<Register />}></Route>
      <Route path="/" element={<Layout />}>
        <Route index element={<Home />}></Route>
        <Route path="/product/:id" element={<ProductDetails />} />
        <Route path="/cart" element={<Cart />}></Route>
        {/* Protected Routes */}
        <Route element={<ProtectedRoute />}>
          <Route path="/order" element={<Order />}></Route>
        </Route>
      </Route>
    </Route>
  )
);

function App() {
  return (
    <div className="font-bodyFont">
      <RouterProvider router={router} />
      <Toaster position="bottom-center" />
    </div>
  );
}

export default App;
