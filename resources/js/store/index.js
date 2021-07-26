import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
      massage:"Welcome, People",
      user:[],
    },
    getters: {
      getMassage(state){
          return state.massage;
      },
      getUser(state){
        return state.user;
      }
    },
    mutations:{
        SET_USER(state, data){
            state.user = data;
        }
    }
  })

export default store;

// state data seen to using getters and also using getMassage() function

// mutations set data into state and then this data return on getters function;