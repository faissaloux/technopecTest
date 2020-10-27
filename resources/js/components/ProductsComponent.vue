<template>
    <div class="products">
        <div class="container">
            <div class="loading">
                <img src="images/gif/loading.gif">
            </div>
            <div class="mt-5">
                <div>
                    <p v-if="products.length">Number of products: <b>{{ products.length }}</b></p>
                    <p v-else>No products disponible</p>
                </div>
                <div class="row container">
                    <div class="card col-md-3" v-for="product in products" :key="product.id">
                        <product-card :product="product"/>
                    </div>
                </div> <!-- End product card -->
                <div v-for="product in products" :key="product.id">
                    <div class="productDetailsCont dC" v-if="productInfoDetails == product.id">
                        <product-details :product="product"/>
                    </div>
                </div> <!-- End product details -->
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    div.loading{
        position: absolute;
        z-index: 2;
        background-color: rgba(#1B1D1F, 1);
        width: 100%;
        height: 92%;
        left: 300px;
        top: 56px;
        display: flex;
        justify-content: center;
        align-items: center;
        img{
            width: 150px;
            height: 150px;
        }
    }
    tbody > tr{
        cursor: pointer;
    }
    form.addProduct{
        input{
            width: 150px;
        }
    }
    div.message{
        color: blue;
        text-align: center;
        p{
        width: 100%;
        }
    }
    div.dC{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, .8);
        cursor: default;
        overflow-y: hidden;

    }
    div.pD{
        position: relative;
        width: 650px;
        height: 400px;
        background-color: #CCC;
        border-radius: 5px;
        
    }
</style>

<script>
    import productCard from './ProductCardComponent';
    import productDetails from './ProductDetailsComponent';

    export default {
        components:{
            productCard,
            productDetails
        },
        methods:{
            closeProductDetails(){
                this.$store.dispatch('updateProductInfoDetails', 0);
            }
        },
        mounted(){
            axios.get('/cart/show')
            .then(response => {
                this.$store.dispatch("updateProducts", response.data);
                $("div.loading").fadeOut();
            });
        },
        computed:{
            productInfoDetails(){
                return this.$store.state.productInfoDetails;
            },
            products(){
                return this.$store.state.products;
            }
        }
    }
</script>