<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
    oneToOne: Object,
    oneToMany: Array,
    oneOfMany: Array,
    manyToMany: Array,
    custom: Array,
    products: Array,
    users: Array,
    orders: Array,
    canLogin: Boolean
});


const currentRelationship = ref('oneToOne')
const modal = ref(false)

const openModal = (relation) =>{
    currentRelationship.value = relation
    modal.value = true
}
const getUserName = (data) =>{
    const user = props.users.find(obj => obj.id === data);
    return user.name
}
const getProductName = (data) =>{
    const product = props.products.find(obj => obj.id === data);
    return product.name
}

</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register</Link>
            </template>
        </div>



        <div class="bg-white py-24 sm:py-32 mt-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl uppercase">polymorphic
                        relationships</h2>
                </div>
                <div
                    class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-y-16 gap-x-8 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                    <button @click="openModal('oneToOne')"
                        class="transform transition hover:scale-110 duration-500 p-10 shadow-2xl flex max-w-xl flex-col items-start justify-between">
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    One To One
                                </a>
                            </h3>
                        </div>
                    </button>

                    <button @click="openModal('oneToMany')"
                        class="transform transition hover:scale-110 duration-500 p-10 shadow-2xl flex max-w-xl flex-col items-start justify-between">
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    One To Many
                                </a>
                            </h3>
                        </div>
                    </button>

                    <button @click="openModal('oneOfMany')"
                        class="transform transition hover:scale-110 duration-500 p-10 shadow-2xl flex max-w-xl flex-col items-start justify-between">
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    One Of Many
                                </a>
                            </h3>
                        </div>
                    </button>

                    <button @click="openModal('manyToMany')"
                        class="transform transition hover:scale-110 duration-500 p-10 shadow-2xl flex max-w-xl flex-col items-start justify-between">
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Many To Many
                                </a>
                            </h3>
                        </div>
                    </button>

                    <button @click="openModal('customType')"
                        class="transform transition hover:scale-110 duration-500 p-10 shadow-2xl flex max-w-xl flex-col items-start justify-between">
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Custom Type
                                </a>
                            </h3>
                        </div>
                    </button>

                    <!-- More posts... -->
                </div>
            </div>
        </div>

        <div v-if="modal" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <div>
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 v-if="currentRelationship=='oneToOne'" class="text-base font-semibold leading-6 text-gray-900"
                                    id="modal-title">
                                    One To One
                                </h3>
                                <h3 v-if="currentRelationship == 'oneToMany'" class="text-base font-semibold leading-6 text-gray-900"
                                    id="modal-title">
                                    One To Many
                                </h3>
                                <h3 v-if="currentRelationship == 'oneOfMany'" class="text-base font-semibold leading-6 text-gray-900"
                                    id="modal-title">
                                    One Of Many
                                </h3>
                                <h3 v-if="currentRelationship == 'manyToMany'" class="text-base font-semibold leading-6 text-gray-900"
                                    id="modal-title">
                                    Many To Many
                                </h3>
                                <h3 v-if="currentRelationship == 'customType'" class="text-base font-semibold leading-6 text-gray-900"
                                    id="modal-title">
                                    Custom Type
                                </h3>

                                <div class="mt-2">
                                    <div class="px-4 sm:px-6 lg:px-8">
                                        <div class="mt-8 flow-root">
                                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                                                    <p v-if="currentRelationship == 'oneToOne'">
                                                        Order Number: {{ oneToOne.id }} <br>
                                                        Order Name: {{ oneToOne.name }} <br>
                                                        Order Price: {{ oneToOne.price }} <br>
                                                        Order Description: {{ oneToOne.description }} <br>
                                                    </p>


                                                    <table  v-if="currentRelationship == 'oneToMany'" class="min-w-full divide-y divide-gray-300">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"
                                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                                    User</th>
                                                                <th scope="col"
                                                                    class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                                                    Product</th>
                                                                <th scope="col"
                                                                    class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                                                    Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-gray-200">

                                                            <tr v-for="item in oneToMany">
                                                                <td
                                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                                    {{ getUserName(item.user_id) }}</td>
                                                                <td
                                                                    class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                                    {{ getProductName(item.orderable_id) }}</td>
                                                                <td
                                                                    class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                                    {{ item.quantity }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button @click="modal=false" type="button"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}</style>
