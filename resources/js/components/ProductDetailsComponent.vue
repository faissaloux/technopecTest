<template>
    <div class="productDetails pD">
        <div class="close" @click="closeProductDetails">X</div>
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
</template>

<style lang="scss" scoped>
    div.scroll{
        overflow-y: scroll;
        height: 275px;
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
    export default {
        props:{
            product:{
                type: Object,
                required: true
            }
        },
        methods:{
            closeProductDetails(){
                this.$store.dispatch('updateProductInfoDetails', 0);
            }
        }
    }
</script>