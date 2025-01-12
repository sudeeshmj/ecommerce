import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  userInfo: {},
  isAuthenticated: false,
};

const userSlice = createSlice({
  name: "user",
  initialState,
  reducers: {
    login: (state, action) => {
      state.userInfo = { ...state.userInfo, ...action.payload };
      state.isAuthenticated = true;
    },
    logout: (state) => {
      if (state.userInfo) {
        state.userInfo = {};
        state.isAuthenticated = false;
      }
    },
  },
});
export const { login, logout } = userSlice.actions;
export default userSlice.reducer;
