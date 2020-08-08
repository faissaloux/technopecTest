@extends('welcome')

@section('cart')
    <div class="cart d-flex" id="cart">
        <div class="left">
            <div class="buttons d-flex flex-column">
                <router-link :to="{ name: 'dashboard' }" class="button d-flex justify-content-center align-items-center">Dashboard</router-link>
                <router-link :to="{ name: 'create' }" class="button d-flex justify-content-center align-items-center">Create</router-link>
                <router-link :to="{ name: 'products' }" class="button d-flex justify-content-center align-items-center">Products</router-link>
            </div>
        </div>
        <div class="right w-100">
            @include('partials.flash')
            <router-view></router-view>
        </div>
    </div>
@endsection