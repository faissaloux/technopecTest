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
                        <product-card   :product="product"
                                        @updateProductInfoDetails="updateProductInfoDetails"/>
                    </div>
                </div> <!-- End product card -->
                <div v-for="product in products" :key="product.id">
                    <div class="productDetailsCont dC" v-if="productInfoDetails == product.id">
                        <div class="productDetails pD">
                            <div class="close" @click="productInfoDetails = 0">X</div>
                            <div class="d-flex">
                                <p class="imgCont d-flex"></p>
                                <div class="d-flex flex-column align-items-left w-100">
                                    <div class="row justify-content-center">
                                        <p class="title">{{ product.product }}</p>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-left">
                                        <div class="w-100" :class="product.variants.length > 3 ? 'scroll' : ''">
                                            <p class="title" v-if="product.variants.length">Variants: </p>
                                            <div v-for="variant in product.variants" :key="variant.id">
                                                <div v-if="variant.size && variant.color && variant.material">
                                                    <span class="col-4">{{ variant.size }}/{{ variant.color }}/{{ variant.material }}</span>
                                                    <span class="col-4">
                                                        <span>{{ variant.price }}</span>
                                                        <span>&nbsp; MAD</span>
                                                    </span>
                                                    <span class="col-4">
                                                        <span>{{ variant.quantity }}</span>
                                                        <span v-if="variant.quantity == 1">Piece</span>
                                                        <span v-else-if="variant.quantity > 1">Pieces</span>
                                                    </span>
                                                </div>
                                                <div v-else-if="variant.size">
                                                    <p v-if="variant.color">
                                                        <span class="col-4">{{ variant.size }}/{{ variant.color }}</span>
                                                        <span class="col-4">
                                                            <span>{{ variant.price }}</span>
                                                            <span>&nbsp; MAD</span>
                                                        </span>
                                                        <span class="col-4">
                                                            <span>{{ variant.quantity }}</span>
                                                            <span v-if="variant.quantity == 1">Piece</span>
                                                            <span v-else-if="variant.quantity > 1">Pieces</span>
                                                        </span>
                                                    </p>
                                                    <p v-else-if="variant.material">
                                                        <span class="col-4">{{ variant.size }}/{{ variant.material }}</span>
                                                        <span class="col-4">
                                                            <span>{{ variant.price }}</span>
                                                            <span>&nbsp; MAD</span>
                                                        </span>
                                                        <span class="col-4">
                                                            <span>{{ variant.quantity }}</span>
                                                            <span v-if="variant.quantity == 1">Piece</span>
                                                            <span v-else-if="variant.quantity > 1">Pieces</span>
                                                        </span>
                                                    </p>
                                                    <p v-else>
                                                        <span class="col-4">{{ variant.size }}</span>
                                                        <span class="col-4">
                                                            <span>{{ variant.price }}</span>
                                                            <span>&nbsp; MAD</span>
                                                        </span>
                                                        <span class="col-4">
                                                            <span>{{ variant.quantity }}</span>
                                                            <span v-if="variant.quantity == 1">Piece</span>
                                                            <span v-else-if="variant.quantity > 1">Pieces</span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div v-else-if="variant.color">
                                                    <p v-if="variant.material">
                                                        <span class="col-4">{{ variant.color }}/{{ variant.material }}</span>
                                                        <span class="col-4">
                                                            <span>{{ variant.price }}</span>
                                                            <span>&nbsp; MAD</span>
                                                        </span>
                                                        <span class="col-4">
                                                            <span>{{ variant.quantity }}</span>
                                                            <span v-if="variant.quantity == 1">Piece</span>
                                                            <span v-else-if="variant.quantity > 1">Pieces</span>
                                                        </span>
                                                    </p>
                                                    <p v-else>
                                                        <span class="col-4">{{ variant.color }}</span>
                                                        <span class="col-4">
                                                            <span>{{ variant.price }}</span>
                                                            <span>&nbsp; MAD</span>
                                                        </span>
                                                        <span class="col-4">
                                                            <span>{{ variant.quantity }}</span>
                                                            <span v-if="variant.quantity == 1">Piece</span>
                                                            <span v-else-if="variant.quantity > 1">Pieces</span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div v-else-if="variant.material">
                                                    <p>
                                                        <span class="col-4">{{ variant.material }}</span>
                                                        <span class="col-4">
                                                            <span>{{ variant.price }}</span>
                                                            <span>&nbsp; MAD</span>
                                                        </span>
                                                        <span class="col-4">
                                                            <span>{{ variant.quantity }}</span>
                                                            <span v-if="variant.quantity == 1">Piece</span>
                                                            <span v-else-if="variant.quantity > 1">Pieces</span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div v-else>
                                                    <p>No variants</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    div.scroll{
        overflow-y: scroll;
        height: 275px;
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
    
    div.close{
        position: absolute;
        top: 5px;
        right: 10px;
        color: #666;
        cursor: pointer;
    }
    div.productDetails{
        div{
            p{
                &.imgCont{
                    background: url("/images/products/product1.jpg");
                    background-size: cover;
                    background-attachment: fixed;
                    height: 400px;
                    width: 50%;
                    overflow: hidden;
                }
                font-size: 24px;
            }
            div{
                margin-left: -6px;
                padding: 10px;
                p{
                    font-size: 18px;
                    &.title{
                        width: 120px;
                        font-weight: 800;
                    }
                }
            }
        }
    }
</style>

<script>
    import productCard from "./ProductCardComponent";

    export default {
        components:{
            productCard
        },
        data(){
            return{
                products: [],
                productInfoDetails: 0
            }
        },
        methods:{
            updateProductInfoDetails(updateProductInfoDetails){
                this.productInfoDetails = updateProductInfoDetails;
            }
        },
        mounted(){
            axios.get('/cart/show')
            .then(response => {
                this.products = response.data;
                $("div.loading").fadeOut();
            });
        },
    }
</script>