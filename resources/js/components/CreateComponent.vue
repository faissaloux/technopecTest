<template>
    <div class="create w-50">
        <div class="create-product ml-2">
            <form class="addProduct" @submit.prevent="create" method="post">
                <div class="message">
                    <p v-if="errorMsg">{{ errorMsg }}</p>
                </div>
                <div class="form-group">
                    <input type="hidden" name="_token" :value="csrf">
                    <h2>Add product</h2>
                    <div class="card p-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" v-model="title" placeholder="Title">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" v-model="description" placeholder="Description"></textarea>
                    </div>
                    <!-- Variants section -->
                    <div class="card p-2 mt-2">
                        <h3>Variants</h3>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input pointer" name="hasVariants" v-model="hasVariants">
                            <label for="hasVariants" class="form-check-label">
                                This product has multiple options, like different sizes or colors
                            </label>
                        </div>
                        <!-- Options section -->
                        <div v-if="hasVariants">
                            <hr>
                            <p>Options</p>
                            <!-- Options section -->
                            <div>
                                <div class="d-flex flex-column" v-for="(option, index) in options" :key="option.id">
                                    <div class="d-flex justify-content-between" v-if="options.length>1">
                                        <h4>Option {{ option.option }}</h4>
                                        <h6 class="float-right pointer" @click="removeOption(index, option.optionSelected)">Remove</h6>
                                    </div>
                                    <div class="row m-2">
                                        <select class="form-control col-2"
                                                name="options" 
                                                v-model="option.optionSelected"
                                                @change="addTag">
                                            <option v-for="(option, index) in optionsToSelect"
                                                    :key="index"
                                                    :value="option">
                                                {{ option }}
                                            </option>
                                        </select>
                                        <div class="col-9 ml-2">
                                            <div class="tagContainer">
                                                <div v-if="option.optionSelected == 'size'">
                                                    <div v-for="(tag, index) in sizeTags" :key="index" class="tags">
                                                        <span class="close" @click="removeTag(index, 'size')">X</span>
                                                        {{ tag.value }}
                                                    </div>
                                                </div>
                                                <div v-else-if="option.optionSelected == 'color'">
                                                    <div v-for="(tag, index) in colorTags" :key="index" class="tags">
                                                        <span class="close" @click="removeTag(index, 'color')">X</span>
                                                        {{ tag.value }}
                                                    </div>
                                                </div>
                                                <div v-else-if="option.optionSelected == 'material'">
                                                    <div v-for="(tag, index) in materialTags" :key="index" class="tags">
                                                        <span class="close" @click="removeTag(index, 'material')">X</span>
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
                            </div> <!-- Options section end -->
                            <!-- Preview section -->
                            <div v-if="tags.length" class="d-flex flex-column">
                                <hr>
                                <p>Preview</p>
                                <div class="row">
                                    <span class="col-md-4">Variant</span>
                                    <span class="col-md-4">Price</span>
                                    <span class="col-md-4">Quantity</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <!-- One variant -->
                                    <div v-if="onlyOne">
                                        <div v-if="sizeTags.length">
                                            <div v-for="(sizeTag, index) in sizeTags" :key="index" class="row">
                                                <span class="col-md-4" :id="index">{{ sizeTag.value }}</span>
                                                <input  type="text"
                                                        class="form-control col-md-4"
                                                        placeholder="Price"
                                                        v-model="price[index]">
                                                <input  type="number"
                                                        class="form-control col-md-4"
                                                        placeholder="Quantity"
                                                        v-model="quantity[index]"
                                                        @blur="fillOneVariant('size', index)">
                                            </div>
                                        </div>
                                        <div v-else-if="colorTags.length">
                                            <div v-for="(colorTag, index) in colorTags" :key="index" class="row">
                                                <span class="col-md-4" :id="index">{{ colorTag.value }}</span>
                                                <input  type="text"
                                                        class="form-control col-md-4"
                                                        placeholder="Price"
                                                        v-model="price[index]">
                                                <input  type="number"
                                                        class="form-control col-md-4"
                                                        placeholder="Quantity"
                                                        v-model="quantity[index]"
                                                        @blur="fillOneVariant('color', index)">
                                            </div>
                                        </div>
                                        <div v-else-if="materialTags.length">
                                            <div v-for="(materialTag, index) in materialTags" :key="index" class="row">
                                                <span class="col-md-4" :id="index">{{ materialTag.value }}</span>
                                                <input  type="text"
                                                        class="form-control col-md-4"
                                                        placeholder="Price"
                                                        v-model="price[index]">
                                                <input  type="number"
                                                        class="form-control col-md-4"
                                                        placeholder="Quantity"
                                                        v-model="quantity[index]"
                                                        @blur="fillOneVariant('material', index)">
                                            </div>
                                        </div>
                                    </div> <!-- One variant end -->
                                    <!-- Color + Size && Color+ Material && All three -->
                                    <div v-else-if="colorTags.length">
                                        <div v-if="sizeTags.length">
                                            <!-- All three variants -->
                                            <div v-if="materialTags.length">
                                                <div v-for="(sizeTag, i) in sizeTags" :key="i">
                                                    <div v-for="(colorTag, index) in colorTags" :key="index">
                                                        <div v-for="(materialTag, k) in materialTags" :key="k" class="row">
                                                            <span class="col-md-4">
                                                            <span :id="'size'+i*100+index*10+k">{{ sizeTag.value }}</span>/
                                                            <span :id="'color'+i*100+index*10+k">{{ colorTag.value }}</span>/
                                                            <span :id="'material'+i*100+index*10+k">{{ materialTag.value }}</span>
                                                        </span>
                                                            <input  type="text"
                                                                    class="form-control col-md-4"
                                                                    placeholder="Price"
                                                                    v-model="price[i*100+index*10+k]">
                                                            <input  type="number"
                                                                    class="form-control col-md-4"
                                                                    placeholder="Quantity"
                                                                    v-model="quantity[i*100+index*10+k]"
                                                                    @blur="fillThreeVariants(i, index, k)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- All three variants end -->
                                            <!-- Color + Size -->
                                            <div v-else>
                                                <div v-for="(sizeTag, i) in sizeTags" :key="i">
                                                    <div v-for="(colorTag, index) in colorTags" :key="index" class="row">
                                                        <span class="col-md-4">
                                                            <span :id="'size'+i*10+index">{{ sizeTag.value }}</span>/
                                                            <span :id="'color'+i*10+index">{{ colorTag.value }}</span>
                                                        </span>
                                                        <input  type="text"
                                                                class="form-control col-md-4"
                                                                placeholder="Price"
                                                                v-model="price[i*10+index]">
                                                        <input  type="number"
                                                                @blur="fillVariant(i, index)"
                                                                class="form-control col-md-4"
                                                                placeholder="Quantity"
                                                                v-model="quantity[i*10+index]">
                                                    </div>
                                                </div>
                                            </div> <!-- Color + Size end  -->
                                        </div>
                                        <!-- Color + Material -->
                                        <div v-else-if="materialTags.length">
                                            <div v-for="(materialTag, i) in materialTags" :key="i">
                                                <div v-for="(colorTag, index) in colorTags" :key="index" class="row">
                                                    <span class="col-md-4">
                                                        <span :id="'material'+i*10+index">{{ materialTag.value }}</span>/
                                                        <span :id="'color'+i*10+index">{{ colorTag.value }}</span>
                                                    </span>
                                                    <input  type="text"
                                                            class="form-control col-md-4"
                                                            placeholder="Price"
                                                            v-model="price[i*10+index]">
                                                    <input  type="number"
                                                            @blur="fillVariant(i, index)"
                                                            class="form-control col-md-4"
                                                            placeholder="Quantity"
                                                            v-model="quantity[i*10+index]">
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- Color + Size && Color+ Material && All three end -->
                                    <!-- Size + Material -->
                                    <div v-else-if="sizeTags.length">
                                        <div v-if="materialTags.length">
                                            <div v-for="(sizeTag, i) in sizeTags" :key="i">
                                                <div v-for="(materialTag, index) in materialTags" :key="index" class="row">
                                                    <span class="col-md-4">
                                                        <span :id="'size'+i*10+index">{{ sizeTag.value }}</span>/
                                                        <span :id="'material'+i*10+index">{{ materialTag.value }}</span>
                                                    </span>
                                                    <input  type="text"
                                                            class="form-control col-md-4"
                                                            placeholder="Price"
                                                            v-model="price[i*10+index]">
                                                    <input  type="number"
                                                            @blur="fillVariant(i, index)"
                                                            class="form-control col-md-4"
                                                            placeholder="Quantity"
                                                            v-model="quantity[i*10+index]">
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- Size+ Material end -->
                                </div>
                            </div> <!-- Preview section end -->

                        </div> <!-- End of option section -->
                    </div> <!-- Variants section end -->
                    <input type="submit" class="btn btn-primary float-right mt-2 col-4" id="saveBtn" value="Save">
                </div>

            </form>
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
            sizeList: [],
            material: [],
            price: [],
            quantity: [],
            priceList: [],
            quantityList: [],
            errorMsg: '',
            variants: [],
            hasVariants: false,
            options: [
                {
                    option: 1,
                    optionSelected: 'size'
                }
            ],
            tags: [],
            colorTags: [],
            sizeTags: [],
            materialTags: [],
            optionsToSelect: ['size', 'color', 'material'],
            onlyOne: false
        }
    },
    methods:{
        addOption(e){
            e.preventDefault();
            this.options.push({option: this.options.length+1});
            this.options[this.options.length-1].optionSelected = 'color';
        },
        idExists(option){
            return document.body.contains(document.getElementById(option)) || null;
        },
        fillOneVariant(option, index){
            let val = this.idExists(index) && document.getElementById(index).innerHTML;

            this.variants.push({id: index});
            this.variants[this.variants.length-1].price = this.priceList[this.variants.length-1];;
            this.variants[this.variants.length-1].quantity = this.quantityList[this.variants.length-1];
            switch(option){
                case 'size':
                    this.variants[this.variants.length-1].size = val
                    this.variants[this.variants.length-1].color = null
                    this.variants[this.variants.length-1].material = null
                    break;
                case 'color':
                    this.variants[this.variants.length-1].color = val
                    this.variants[this.variants.length-1].size = null
                    this.variants[this.variants.length-1].material = null
                    break;
                case 'material':
                    this.variants[this.variants.length-1].material = val
                    this.variants[this.variants.length-1].size = null
                    this.variants[this.variants.length-1].color = null
                    break;
            }
        },
        fillVariant(i, index){
            let sizeVal = this.idExists('size'+i*10+index) && document.getElementById('size'+i*10+index).innerHTML;
            let colorVal = this.idExists('color'+i*10+index) && document.getElementById('color'+i*10+index).innerHTML;
            let materialVal = this.idExists('material'+i*10+index) && document.getElementById('material'+i*10+index).innerHTML;

            // variants
            this.variants.push({id: i*10+index});
            this.variants[this.variants.length-1].price = this.priceList[this.variants.length-1];
            this.variants[this.variants.length-1].quantity = this.quantityList[this.variants.length-1];
            this.variants[this.variants.length-1].size = sizeVal;
            this.variants[this.variants.length-1].color = colorVal;
            this.variants[this.variants.length-1].material = materialVal;
        },
        fillThreeVariants(i, index, k){
            let sizeVal = this.idExists('size'+i*100+index*10+k) && document.getElementById('size'+i*100+index*10+k).innerHTML;
            let colorVal = this.idExists('color'+i*100+index*10+k) && document.getElementById('color'+i*100+index*10+k).innerHTML;
            let materialVal = this.idExists('material'+i*100+index*10+k) && document.getElementById('material'+i*100+index*10+k).innerHTML;

            this.variants.push({id: i*100+index*10+k});
            this.variants[this.variants.length-1].price = this.priceList[this.variants.length-1];
            this.variants[this.variants.length-1].quantity = this.quantityList[this.variants.length-1];
            this.variants[this.variants.length-1].size = sizeVal;
            this.variants[this.variants.length-1].color = colorVal;
            this.variants[this.variants.length-1].material = materialVal;
        },
        removeOption(index, option){
            var f = [];
            switch(option){
                case 'color':
                    this.colorTags = []
                    f = this.tags.filter(tag => tag.option !== 'color')
                    this.tags = f
                    break;
                case 'size':
                    this.sizeTags = []
                    f = this.tags.filter(tag => tag.option !== 'size')
                    this.tags = f
                    break;
                case 'material':
                    this.materialTags = []
                    f = this.tags.filter(tag => tag.option !== 'material')
                    this.tags = f
                    break;
            }
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
        removeTag(i, option){
            let deleted;
            switch(option){
                case 'color':
                    deleted = this.colorTags.splice(i, 1)
                    break;
                case 'size':
                    deleted = this.sizeTags.splice(i, 1)
                    break;
                case 'material':
                    deleted = this.materialTags.splice(i, 1)
                    break;
            }

            var tagsLength = this.tags.length, j;
            for(j = 0; j<=tagsLength; j++){
                this.tags[j] === deleted[0] && this.tags.splice(j, 1);
            }
        },
        removeLastTag(e){
            var i, option = e.target.name;
            switch(option){
                case 'color':
                    i = this.colorTags.length
                    break;
                case 'size':
                    i = this.sizeTags.length
                    break;
                case 'material':
                    i = this.materialTags.length
                    break;
            }
            e.target.value.length === 0 && this.removeTag(i-1, option);
        },
        create(){
            $("#saveBtn").val("Saving ...");
            axios.post('/cart/create',
            {   title: this.title,
                description: this.description,
                variants: this.variants,
            })
            .then( response => {
                $("#saveBtn").val("Saved").css("backgroundColor", "#5BED53");;
            })
            .catch( error =>{
                $("#saveBtn").val("Something wrong").css("backgroundColor", "#ED5B53");
                this.errorMsg = "Check if any field is empty!"
                $("html").animate({scrollTop: 0}, 600);
            })
        }
        
    },
    watch:{
        tags(){
            if(this.colorTags.length){
                if(this.sizeTags.length || this.materialTags.length){
                    this.onlyOne = false;
                }else{
                    this.onlyOne = true;
                }
            }else if(this.sizeTags.length){
                if(this.colorTags.length || this.materialTags.length){
                    this.onlyOne = false;
                }else{
                    this.onlyOne = true;
                }
            }else if(this.materialTags.length){
                if(this.colorTags.length || this.sizeTags.length){
                    this.onlyOne = false;
                }else{
                    this.onlyOne = true;
                }
            }
        },
        hasVariants(){
            this.tags = [];
            this.colorTags = [],
            this.sizeTags = [],
            this.materialTags = [],
            this.options = [{
                option: 1,
                optionSelected: 'size'
            }],
            this.price = [],
            this.quantity = [],
            this.priceList = [],
            this.quantityList = [],
            this.variants = []

        },
        price(){
            this.priceList = this.price.filter(p => Number.isInteger(parseInt(p)));
        },
        quantity(){
            this.quantityList = this.quantity.filter(p => Number.isInteger(parseInt(p)));
        }
    }
}
</script>

<style scoped lang="scss">
    // Variables
    @import '../../sass/variables';

    div.message{
        margin-left: -10px;
        p{
            background-color: $error;
            color: #FFF;
            text-align: center;
        }
    }
    .pointer{
        cursor: pointer;
    }
    textarea {
        resize: none;
        height: 200px;
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
