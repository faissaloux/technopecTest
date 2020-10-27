import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        productInfoDetails: 0,
        products: []
    },
    mutations:{
        productInfoDetailsMutation: (state, productInfoDetails) => {
            state.productInfoDetails = productInfoDetails;
        },
        productsMutation: (state, products) => {
            state.products = products;
        }
    },
    actions:{
        updateProductInfoDetails: (context, productInfoDetails) => {
            context.commit("productInfoDetailsMutation", productInfoDetails);
        },
        updateProducts: (context, products) => {
            context.commit("productsMutation", products);
        }
    }
})