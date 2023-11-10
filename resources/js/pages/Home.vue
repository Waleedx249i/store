<template>
    <div class="bg-gray-200">
        <nav-bar />


        <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">


            <div class="grid grid-cols-1 gap-x-6 gap-y-9 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-4">
                <div v-for="product in products" :key="product.id"
                    class="group bg-white bg-opacity-25  shadow-2xl rounded-3xl px-2  py-3 ">
                    <div
                        class="w-full overflow-hidden bg-gray-200 rounded-xl aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                        <img :src=product.image class="object-cover object-center w-full h-full group-hover:opacity-75" />
                    </div>
                    <h1 class=" px-3 h-10 pt-4 pb-3 overflow-hidden text-black">{{ product.name }}</h1>
                    <div class="flex justify-between py-4 px-3">
                        <p class="mt-1 text-lg font-medium text-gray-900">${{ product.price }} </p>

                        <button @click="addToCart(product)"
                            class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700">add to
                            cart</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios'
import NavBar from '../components/NavBar.vue';
import { mapActions } from 'vuex';

export default {
    components: {
        NavBar,
    },
    data() {
        return {
            products: [],
            categories: [],
            selected: {
                categories: [],
            }
        }
    },



    mounted() {
        this.loadProducts();
        this.loadCategories();
    },

    watch: {
        selected: {
            handler: function () {
                this.loadCategories();
                this.loadProducts();
            },
            deep: true
        }
    },

    methods: {


        addToCart(product) {
            this.$store.dispatch('addToCart', product);



        },
        loadCategories: function () {
            axios.get('http://127.0.0.1:8001/api/category', {
                params: this.selected.categories
            })
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        loadProducts: function () {
            axios.get('http://127.0.0.1:8001/api/product', {
                params: this.selected
            })
                .then((response) => {
                    this.products = response.data.data;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    }
}

</script>
