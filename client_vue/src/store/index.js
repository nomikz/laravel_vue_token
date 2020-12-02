import Vue from 'vue'
import Vuex from 'vuex'
import User from "@/apis/User";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
      'authUser': null,
      'notification': {
          isVisible: false,
          text: '',
          color: 'green'
      },
  },
  mutations: {
      SET_AUTH_USER(state, authUser) {
          state.authUser = authUser;
      },
      LOGOUT(state) {
          state.authUser = null;
      },
      SET_NOTIFICATION(state, notification) {
          state.notification.color = notification.color;
          state.notification.text = notification.text;
          state.notification.isVisible = true;
      },
      SWITCH_OFF_NOTIFICATION(state) {
          state.notification.isVisible = false;
      }
  },
  actions: {
      setAuthUser({commit}) {
          User.auth()
              .then(({ data }) => {
                  commit('SET_AUTH_USER', data);
              })
              .catch(() => {
                  localStorage.removeItem('token');
              })
      },
      logout({commit}) {
          commit('LOGOUT');
      },
      setNotification({commit}, notification) {
          commit('SET_NOTIFICATION', notification);
          setTimeout(() => {commit('SWITCH_OFF_NOTIFICATION')}, 2000);
      }
  },
  modules: {
  }
})
