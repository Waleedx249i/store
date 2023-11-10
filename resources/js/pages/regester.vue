<template>
    <div class="flex justify-center items-center h-screen">
        <div class="w-1/3">
            <h2 class="text-2xl font-bold mb-4">Register</h2>
            <form @submit.prevent="register">
                <div class="mb-4">
                    <input type="text" v-model="name" placeholder="Name"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <p v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</p>
                </div>
                <div class="mb-4">
                    <input type="email" v-model="email" placeholder="Email"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <p v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</p>
                </div>
                <div class="mb-4">
                    <input type="password" v-model="password" placeholder="Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <p v-if="errors.password" class="text-red-500 text-sm">{{ errors.password }}</p>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Register</button>
            </form>
        </div>
    </div>
</template>
  
<script>
import { mapActions } from 'vuex';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            errors: {},
        };
    },
    methods: {
        ...mapActions('auth', ['registerUser']),
        register() {
            this.errors = {};

            if (!this.validateForm()) {
                return;
            }

            const userData = {
                name: this.name,
                email: this.email,
                password: this.password,
            };

            this.registerUser(userData)
                .then(() => {
                    // Redirect to home or intended route
                    this.$router.push('/');
                })
                .catch(error => {
                    console.error(error);
                });
        },
        validateForm() {
            let isValid = true;

            if (!this.name) {
                this.errors.name = 'Name isrequired.';
                isValid = false;
            }

            if (!this.email) {
                this.errors.email = 'Email is required.';
                isValid = false;
            }

            if (!this.password) {
                this.errors.password = 'Password is required.';
                isValid = false;
            }

            return isValid;
        },
    },
};
</script>