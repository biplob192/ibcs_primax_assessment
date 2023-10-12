import { createStore } from "vuex";
import state from "./state";
import * as getters from "./getters";
import * as mutations from "./mutations";
import * as actions from "./actions";

// Import Modules
import admin from "./modules/admin";
import auth from "./modules/auth";
import user from "./modules/user";
import project from "./modules/project";

const store = createStore({
  namespaced: true,
  state,
  getters,
  mutations,
  actions,

  modules: {
    admin,
    auth,
    user,
    project,
  },
});

export default store;
