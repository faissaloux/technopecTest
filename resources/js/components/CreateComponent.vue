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
                            <input type="checkbox" class="form-check-input pointer" name="hasVariants" v-model="hasVariants">
                            <label for="hasVariants" class="form-check-label">
                                This product has multiple options, like different sizes or colors
                            </label>
                        </div>
                        <div v-if="hasVariants">
                            <hr>
                            <p>Options</p>
                            <div>
                                <div class="d-flex flex-column" v-for="(option, index) in options" :key="option.id">
                                    <div class="d-flex justify-content-between" v-if="options.length>1">
                                        <h4>Option {{ option.option }}</h4>
                                        <h6 class="float-right pointer" @click="removeOption(index)">Remove</h6>
                                    </div>
                                    <div class="row m-2">
                                        <select class="form-control col-2" name="options" v-model="option.optionSelected">
                                            <option value="size">Size</option>
                                            <option value="color">Color</option>
                                            <option value="material">Material</option>
                                        </select>
                                        <div class="col-9 ml-2">
                                            <div class="tagContainer">
                                                <div v-if="option.optionSelected == 'size'">
                                                    <div v-for="(tag, index) in sizeTags" :key="index" class="tags">
                                                        <span class="close" @click="removeTag(index)">X</span>
                                                        {{ tag.value }}
                                                    </div>
                                                </div>
                                                <div v-if="option.optionSelected == 'color'">
                                                    <div v-for="(tag, index) in colorTags" :key="index" class="tags">
                                                        <span class="close" @click="removeTag(index)">X</span>
                                                        {{ tag.value }}
                                                    </div>
                                                </div>
                                                <div v-if="option.optionSelected == 'material'">
                                                    <div v-for="(tag, index) in materialTags" :key="index" class="tags">
                                                        <span class="close" @click="removeTag(index)">X</span>
                                                        {{ tag.value }}
                                                    </div>
                                                </div>
                                                <input  type="text"
                                                        @keydown.enter='addTag' 
                                                        @keydown.188='addTag'
                                                        @keydown.delete='removeLastTag'
                                                        class="form-control"
                                                        :name="option.optionSelected == 'size'
                                                                    ? 'size'
                                                                    : option.optionSelected == 'color'
                                                                        ? 'color'
                                                                        : option.optionSelected == 'material'
                                                                            ? 'material'
                                                                            : ''"
                                                        placeholder="Separate options with a comma">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                </div>
                                
                                <button class="btn btn-secondary" @click="addOption">Add another option</button>
                            </div>

                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary float-right mt-2 col-4" value="Save">
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
            color: [],
            size: [],
            material: [],
            quantity: '',
            price: '',
            msg: '',
            hasVariants: false,
            options: [
                {
                    option: 1,
                    optionSelected: 'size'
                }
            ],
            tags: [
                {
                    option: '',
                    value: ''
                }
            ],
            colorTags: [],
            sizeTags: [],
            materialTags: []
        }
    },
    methods:{
        addOption(e){
            e.preventDefault();
            this.options.push({option: this.options.length+1});
            this.options[this.options.length-1].optionSelected = 'color';
        },
        removeOption(index){
            this.options.splice(index, 1);
            var optionsLen = this.options.length;
            for(var i=0; i<optionsLen; i++){
                this.options[i].option = i+1;
            }
        },
        addTag(e){
            e.preventDefault();
            var option = this.options.optionSelected;
            var name = e.target.name;
            var val = e.target.value.trim();
            this.sizeTags = [];
            this.colorTags = [];
            this.materialTags = [];
            if(val.length > 0){
                if(name === 'size'){
                    this.tags.push({option: 'size', value: val});
                } else if (name === 'color'){
                    this.tags.push({option: 'color', value: val});
                } else if (name === 'material'){
                    this.tags.push({option: 'material', value: val});
                }
                e.target.value = '';
            }
            
            for(var i = 0; i< this.tags.length; i++){
                if(this.tags[i].option === 'size'){
                    this.sizeTags.push(this.tags[i]);
                } else if(this.tags[i].option === 'color'){
                    this.colorTags.push(this.tags[i]);
                } else if(this.tags[i].option === 'material'){
                    this.materialTags.push(this.tags[i]);
                };
            }
        },
        removeTag(i){
            if(this.tags[i].option === 'size'){
                this.sizeTags.splice(i, 1);
            } else if(this.tags[i].option === 'color'){
                this.colorTags.splice(i, 1);
            } else if(this.tags[i].option === 'material'){
                this.materialTags.splice(i, 1);
            };
            this.tags.splice(i, 1);
        },
        removeLastTag(e){
            if(e.target.value.length === 0){
                this.removeTag(this.tags.length - 1)
            }
        },
        create(){
            axios.post('/cart/create',
            {   title: this.title,
                desciption: this.description,
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
    .pointer{
        cursor: pointer;
    }
    .tagContainer{
        width: 100%;
        border: 1px solid #eee;
        font-size: 0.9em;
        padding: 0 10px;
        >input{
            border: none;
            outline: none;
            background: none;
            font-size: 0.9em;
            line-height: 50px;
        }
    }
    .tags{
        height: 30px;
        float: left;
        margin-right: 10px;
        background-color: #ddd;
        margin-top: 5px;
        line-height: 30px;
        padding: 0 5px;
        border-radius: 5px;
        span.close{
            cursor: pointer;
            font-size: 1rem;
            line-height: 30px;
            margin-left: 5px;
        }
    }
</style>
