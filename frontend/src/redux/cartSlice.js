import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  cartList: [],
};

const cartSlice = createSlice({
  name: "cart",
  initialState,
  reducers: {
    addToCart: (state, action) => {
      const itemExist = state.cartList.find((item) => item.id === action.payload.id);
      if (!itemExist) {
        state.cartList.push({
          ...action.payload,
          count: 1,
        });
      }
    },
    changeQuantity: (state, action) => {
      const { id, count } = action.payload;
      const item = state.cartList.find((item) => item.id === id);
      if (item) {
        item.count = count;
      }
    },
    removeCartItem: (state, action) => {
      console.log("Removing item with ID:", action.payload);
      state.cartList = state.cartList.filter((item) => item.id !== action.payload);
    },
  },
});

export const { addToCart, changeQuantity, removeCartItem } = cartSlice.actions;
export default cartSlice.reducer;
