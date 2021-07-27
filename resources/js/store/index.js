import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)
import router from '../router/index'

const store = new Vuex.Store({
    state: {
      massage:"Welcome, People",
      user:[],
      authenticated:false,
    },
    getters: {
      getMassage(state){
          return state.massage;
      },
      getUser(state){
        return state.user;
      },
      getAuthenticated(state){
          return state.authenticated;
      }
    },
    mutations:{
        SET_USER(state, data){
            state.user = data;
        },
        SET_AUTHENTICATED(state,data){
            state.authenticated = data;
        },
    },
    actions:{
      authUser ({ commit, dispatch }) {
        return axios.get('/api/user').then((response) => {
            commit('SET_AUTHENTICATED', true)
            commit('SET_USER', response.data)
            localStorage.setItem("auth", true);
            
            if(router.currentRoute.name !== null){
                router.push({ name: 'dashboard' })
            };

        }).catch(() => {
            commit('SET_AUTHENTICATED', false)
            commit('SET_USER', null)
            localStorage.removeItem("auth");

            if(router.currentRoute.name !== 'login'){
                router.push({ name: 'login' })
            };
        })
      },
    },



    
  })

export default store;

// state data seen to using getters and also using getMassage() function

// mutations set data into state and then this data return on getters function;

// auth(login)->mutations(SET_USER)->state(user)->gutters(getUser)->dashboard(index)