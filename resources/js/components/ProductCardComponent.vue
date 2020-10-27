<template>
    <div>
        <img class="card-img-top" src="/images/products/product1.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ product.product }}</h5>
            <p class="card-text">{{ product.description }}</p>
            <p>Quantity: {{ product.variants.length ? '+'+product.variants.length : 1 }}</p>
            <button @click="productDetails(product.id)" class="btn btn-primary float-right">Details</button>
        </div>
    </div>
</template>

<style lang="scss" scoped>

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
            productDetails(productId){
                this.$emit("updateProductInfoDetails", productId);
                $("html").animate({scrollTop: 0}, 600);
            }
        },
    }
</script>