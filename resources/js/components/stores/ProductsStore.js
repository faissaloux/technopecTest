import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        productInfoDetails: 0
    },
    mutations:{
        updateProductInfoDetails: (state, productInfoDetails) => {
            state.productInfoDetails = productInfoDetails;
        }
    },
    actions:{
        updateProductInfoDetails: (context, productInfoDetails) => {
            context.commit("updateProductInfoDetails", productInfoDetails);
        }
    }
})