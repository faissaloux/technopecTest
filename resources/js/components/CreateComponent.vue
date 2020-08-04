<template>
    <div class="create">
        <div class="create-product ml-2">
            <form class="addProduct" @submit.prevent="create" method="post">
                <div class="form-group">
                    <input type="hidden" name="_token" :value="csrf">
                    <h2>Add product</h2>
                    <div class="card p-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" v-model="title" placeholder="Title">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" v-model="description" placeholder="Description"></textarea>
                    </div>
                    <div class="card p-2 mt-2">
                        <h3>Variants</h3>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hasVariants" v-model="hasVariants">
                            <label for="hasVariants" class="form-check-label">
                                This product has multiple options, like different sizes or colors
                            </label>
                        </div>
                        <div v-if="hasVariants">
                            <hr>
                            <p>Options</p>
                            <div>
                                <div v-for="option in options">
                                    <h4>Option {{ option.option }}</h4>
                                    <div class="row m-2">
                                        <select class="form-control col-2" name="options">
                                            <option value="size">Size</option>
                                            <option value="color" selected>Color</option>
                                            <option value="material">Material</option>
                                        </select>
                                        <div class="col-9 ml-2">
                                            <div></div>
                                            <input  type="text"
                                                    class="form-control"
                                                    name=""
                                                    placeholder="Separate options with a comma">
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <button class="btn btn-secondary" @click="addOption">Add another option</button>
                            </div>

                        </div>
                    </div>
                </div>
                
                <!-- <input type="text" name="color" v-model="color" placeholder="Color">
                <input type="text" name="size" v-model="size" placeholder="Size">
                <input type="text" name="material" v-model="material" placeholder="Material">
                <input type="number" name="quantity" v-model="quantity" placeholder="Quantity">
                <input type="number" name="price" v-model="price" placeholder="Price">
                <input type="submit" value="Add"> -->
            </form>
            <div class="message row container">
                <p v-if="msg">{{ msg }}</p>
            </div>
        </div> <!-- End create-product -->
    </div>
</template>

<script>
export default {
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            title: '',
            description: '',
            color: '',
            size: '',
            material: '',
            quantity: '',
            price: '',
            msg: '',
            hasVariants: false,
            options: [
                {option: 1}
            ],
            colorTags: ['Red', 'Blue']
        }
    },
    methods:{
        addOption(){
            this.options.push({option: this.options.length+1});
        },
        create(){
            axios.post('/cart/create',
            {   product: this.product,
                color: this.color,
                size: this.size,
                material: this.material,
                quantity: this.quantity,
                price: this.price
            })
            .then(response => {
                this.msg = "Product added successfully!"
                console.log(response.data);
            })
            .catch( error =>{
                this.msg = "Check if any field is empty!"
            })
        },
    }
}
</script>

<style scoped lang="scss">
    form{
        input{
            &[type="checkbox"]{
                cursor: pointer;
            }
        }
    }
</style>