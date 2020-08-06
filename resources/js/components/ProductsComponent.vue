<template>
    <div class="products">
        <div class="container">
            <div class="mt-5">
                <div>
                    <p>Number of products: {{ products.length }}</p>
                </div>
                <div class="row container">
                    <div class="card col-md-3" v-for="product in products" :key="product.id">
                        <img class="card-img-top" src="/images/products/product1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ product.product }}</h5>
                            <p class="card-text">Some description</p>
                            <p>Quantity: {{ product.quantity }}</p>
                            <p>Price: {{ product.price }} <span class="float-right">MAD</span></p>
                            <button @click="productDetails(product.id)" class="btn btn-primary float-right">Details</button>
                        </div>
                    </div>
                </div> <!-- End product card -->
                <div v-for="product in products" :key="product.id">
                    <div class="productDetailsCont dC" v-if="productInfoDetails == product.id">
                        <div class="productDetails pD">
                            <div class="close" @click="productInfoDetails = 0">X</div>
                            <div class="d-flex">
                                <p class="imgCont d-flex"></p>
                                <div class="d-flex flex-column align-items-left">
                                    <div class="row">
                                        <span class="title">Product: </span>
                                        <span>{{ product.product }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="title">Colors: </span>
                                        <span v-for="color in product.colors" :key="color.id">{{ color.color }} &nbsp; </span>
                                    </div>
                                    <div class="row">
                                        <span class="title">Sizes: </span>
                                        <span v-for="size in product.sizes" :key="size.id">{{ size.size }} &nbsp; </span>
                                    </div>
                                    <div class="row">
                                        <span class="title">Materials: </span>
                                        <span v-for="material in product.materials" :key="material.id">{{ material.material }} &nbsp; </span>
                                    </div>
                                    <div class="row">
                                        <span class="title">Quantity: </span>
                                        <span>{{ product.quantity }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="title">Price: </span>
                                        <span>{{ product.price }} MAD</span>
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

<script>
export default {
    props: [''],
    data(){
        return{
            products: [],
            productInfoDetails: 0
        }
    },
    methods:{
        productDetails(productId){
            this.productInfoDetails = productId;
            $("html").animate({scrollTop: 0}, 600);
        }
    },
    mounted(){
        axios.get('/cart/show')
        .then(response => {
            this.products = response.data;
        });
    },
}
</script>

<style scoped lang="scss">
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
        width: 600px;
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
                margin-left: 5px;
                padding: 10px;
                span{
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