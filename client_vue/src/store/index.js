import Vue from 'vue'
import Vuex from 'vuex'
import User from "@/apis/User";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
      'authUser': null,
  },
  mutations: {
      SET_AUTH_USER(state, authUser) {
          state.authUser = authUser;
      },
      LOGOUT(state) {
          state.authUser = null;
      },
  },
  actions: {
      setAuthUser({commit}) {
          User.auth()
              .then(({ data }) => {
                  console.log(data);
                  commit('SET_AUTH_USER', data);
              })
              .catch(() => {
                  commit('LOGOUT');
              })
      },
      logout({commit}) {
          User.logout()
              .then(() => {
                  commit('LOGOUT');
              })
              .catch(() => {
                  commit('LOGOUT');
              });
      }
  },
  modules: {
  }
})
