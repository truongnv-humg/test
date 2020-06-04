import Vuex from "vuex"
import Vue from "vue"
import post from './modules/post';
Vue.use(Vuex);
const store = new Vuex.Store({
    modules: {
        post: post
    },

    actions: {
        test() {
            console.log(123)
        }
    }
});

export default store