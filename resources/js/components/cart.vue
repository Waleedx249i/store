<template>
    <div v-if="$store.state.showcart" class=" z-10 ease-in-out" aria-labelledby="slide-over-title" role="dialog"
        aria-modal="true">
        <!--
              Background backdrop, show/hide based on slide-over state.
          
              Entering: "ease-in-out duration-500"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in-out duration-500"
                From: "opacity-100"
                To: "opacity-0"
            -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <!--
                    Slide-over panel, show/hide based on slide-over state.
          
                    Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                      From: "translate-x-full"
                      To: "translate-x-0"
                    Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                      From: "translate-x-0"
                      To: "translate-x-full"
                  -->
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping
                                        cart</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button @click="$store.commit('showHide')" type="button"
                                            class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="absolute -inset-0.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                                            <li v-for="item in cartItems" :key="item.id" class="flex py-6">
                                                <div
                                                    class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                    <img :src="item.image" :alt="item.name"
                                                        class="h-full w-full object-cover object-center">
                                                </div>

                                                <div class="ml-4 flex flex-1 flex-col">
                                                    <div>
                                                        <div
                                                            class="flex justify-between text-base font-medium text-gray-900">
                                                            <h3>
                                                                <a href="#"> {{ item.name }}</a>
                                                            </h3>
                                                            <p class="ml-4">{{ item.price }}</p>
                                                        </div>
                                                        <p class="mt-1 text-sm text-gray-500">Salmon</p>
                                                    </div>
                                                    <div class="flex flex-1 items-end justify-between text-sm">
                                                        <p class="text-gray-500">Quantity: {{ item.quantity }}</p>
                                                        <button @click="incrementQuantity(item.id)"
                                                            class="bg-blue-500 text-white px-2 py-1 rounded">+</button>
                                                        <button @click="decrementQuantity(item.id)"
                                                            class="bg-blue-500 text-white px-2 py-1 rounded">-</button>

                                                        <div class="flex">
                                                            <button type="button" @click="removeFromCart(item.id)"
                                                                class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>


                                            <!-- More products... -->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Total</p>
                                    <p> {{ cartTotal }}</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.
                                </p>
                                <div class="mt-6">
                                    <checkout-form />
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        or
                                        <button @click="$store.commit('showHide')" type="button"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Continue Shopping
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import axios from 'axios'
import CheckoutForm from './CheckoutForm.vue';

export default {
    components: {
        'checkout-form': CheckoutForm
    },
    computed: {
        ...mapGetters(['cartItems', 'cartTotal']),
    },
    methods: {
        ...mapActions(['addToCart', 'updateCartItemQuantity', 'removeFromCart', 'clearCart', 'showHide']),
        incrementQuantity(productId) {
            const cartItem = this.cartItems.find(item => item.id === productId);
            if (cartItem) {
                const newQuantity = cartItem.quantity + 1;
                this.updateCartItemQuantity({ productId, quantity: newQuantity });
            }
        },
        decrementQuantity(productId) {
            const cartItem = this.cartItems.find(item => item.id === productId);
            if (cartItem && cartItem.quantity > 1) {
                const newQuantity = cartItem.quantity - 1;
                this.updateCartItemQuantity({ productId, quantity: newQuantity });
            }
        },

    },
};
</script>
