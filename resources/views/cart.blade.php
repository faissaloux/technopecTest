@extends('welcome')

@section('cart')
    <div class="cart d-flex" id="cart">
        <div class="left">
            <div class="buttons">
                <button @click="dashboardSection = true, productsSection = false, createSection = false"
                        :class="dashboardSection ? 'active': ''">
                    Dashboard
                </button>
                <button @click="createSection = true, dashboardSection = false, productsSection = false"
                        :class="createSection ? 'active': ''">
                    Create
                </button>
                <button @click="productsSection = true, dashboardSection = false, createSection = false"
                        :class="productsSection ? 'active': ''">
                    Products
                </button>
            </div>
        </div>
        <div class="right w-50">
            
            <dashboard-component v-if="dashboardSection"></dashboard-component>
            <create-component v-if="createSection"></create-component>
            <products-component v-if="productsSection"></products-component>
        </div>
    </div>
@endsection