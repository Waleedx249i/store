<template>
    <div>
        <header class="border-b md:flex md:items-center md:justify-between bg-white sticky p-3 pb-0 shadow md:pb-4">

            <!-- Logo text or image -->
            <div class="flex items-center ml-9 justify-between mb-4 md:mb-0">
                <h1 class="leading-none text-2xl text-grey-darkest">
                    <router-link class="no-underline text-gray-400 hover:text-black" to='/store/home'>
                        store
                    </router-link>

                </h1>


                <a class="text-black hover:text-orange md:hidden" href="#">
                    <i class="fa fa-2x fa-bars"></i>
                </a>
            </div>

            <!-- END Logo text or image -->

            <!-- Search field -->
            <form class="mb-4 w-full md:mb-0 md:w-1/4">
                <label class="hidden" for="search-form">Search</label>
                <input class="bg-grey-lightest border-2 focus:border-orange p-2 rounded-lg shadow-inner w-full"
                    placeholder="Search" type="text">
                <button class="hidden">Submit</button>
            </form>
            <!-- END Search field -->

            <!-- Global navigation -->
            <nav class="justify-between">
                <ul class="list-reset md:flex md:items-center">

                    <li style="" class="md:ml-4">
                        <a class="border-t text-gray-400 font-bold block no-underline hover:text-indigo-500 py-2 text-grey-darkest  md:border-none md:p-0"
                            href="#">
                            <router-link to="/store/home"> home</router-link>
                        </a>
                    </li>
                    <li class="md:ml-4">
                        <a
                            class="border-t text-gray-400 font-bold block no-underline hover:text-indigo-500 py-2 text-grey-darkest  md:border-none md:p-0">
                            <router-link to="/store/about"> about</router-link>
                        </a>
                    </li>
                    <li class="md:ml-4">
                        <a
                            class="border-t text-gray-400 font-bold block no-underline hover:text-indigo-500 py-2 text-grey-darkest  md:border-none md:p-0">
                            <button @click="logoutUser"> logout</button>
                        </a>
                    </li>
                    <li class="px-4">
                        <button @click="showHide">
                            <svg class="svg-icon hover:text-indigo-500" viewBox="0 0 20 20">
                                <path fill="none"
                                    d="M17.671,13.945l0.003,0.002l1.708-7.687l-0.008-0.002c0.008-0.033,0.021-0.065,0.021-0.102c0-0.236-0.191-0.428-0.427-0.428H5.276L4.67,3.472L4.665,3.473c-0.053-0.175-0.21-0.306-0.403-0.306H1.032c-0.236,0-0.427,0.191-0.427,0.427c0,0.236,0.191,0.428,0.427,0.428h2.902l2.667,9.945l0,0c0.037,0.119,0.125,0.217,0.239,0.268c-0.16,0.26-0.257,0.562-0.257,0.891c0,0.943,0.765,1.707,1.708,1.707S10,16.068,10,15.125c0-0.312-0.09-0.602-0.237-0.855h4.744c-0.146,0.254-0.237,0.543-0.237,0.855c0,0.943,0.766,1.707,1.708,1.707c0.944,0,1.709-0.764,1.709-1.707c0-0.328-0.097-0.631-0.257-0.891C17.55,14.182,17.639,14.074,17.671,13.945 M15.934,6.583h2.502l-0.38,1.709h-2.312L15.934,6.583zM5.505,6.583h2.832l0.189,1.709H5.963L5.505,6.583z M6.65,10.854L6.192,9.146h2.429l0.19,1.708H6.65z M6.879,11.707h2.027l0.189,1.709H7.338L6.879,11.707z M8.292,15.979c-0.472,0-0.854-0.383-0.854-0.854c0-0.473,0.382-0.855,0.854-0.855s0.854,0.383,0.854,0.855C9.146,15.596,8.763,15.979,8.292,15.979 M11.708,13.416H9.955l-0.189-1.709h1.943V13.416z M11.708,10.854H9.67L9.48,9.146h2.228V10.854z M11.708,8.292H9.386l-0.19-1.709h2.512V8.292z M14.315,13.416h-1.753v-1.709h1.942L14.315,13.416zM14.6,10.854h-2.037V9.146h2.227L14.6,10.854z M14.884,8.292h-2.321V6.583h2.512L14.884,8.292z M15.978,15.979c-0.471,0-0.854-0.383-0.854-0.854c0-0.473,0.383-0.855,0.854-0.855c0.473,0,0.854,0.383,0.854,0.855C16.832,15.596,16.45,15.979,15.978,15.979 M16.917,13.416h-1.743l0.189-1.709h1.934L16.917,13.416z M15.458,10.854l0.19-1.708h2.218l-0.38,1.708H15.458z">
                                </path>
                            </svg>
                        </button>
                    </li>
                </ul>

            </nav>
            <!-- END Global navigation -->

        </header>
    </div>
</template>
<script>
import { mapActions } from 'vuex';
export default {
    name: 'NavBar',

    methods: {
        ...mapActions('auth', ['logoutUser']),
        ...mapActions(['showHide'])
    }

}


</script>