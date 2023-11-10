<template>
    <form @submit.prevent="redirectToCheckout">
        <button
            class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700"
            type="submit">Checkout</button>
    </form>
</template>
  
<script>
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';
export default {
    computed: {
        ...mapGetters(['cartItems']),
    },
    methods: {
        async redirectToCheckout() {
            const response = await axios.post('http://127.0.0.1:8001/api/checkout', {

                'cartItems': this.cartItems,

            });

            const sessionId = response.data.sessionId;

            const stripe = Stripe('pk_test_qBj4heVn3q9QcukzkQX8yesT00O3Y2ojdx');
            const { error } = await stripe.redirectToCheckout({
                sessionId: sessionId,
            });

            if (error) {
                console.error(error);
                // Handle error
            }
        },
    },
};
</script>