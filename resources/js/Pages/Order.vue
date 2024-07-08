<script setup>
import { ref, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const orderDispatch = ref(false);
const delivered = ref(false);
const order = ref(null);

onMounted(() => {
    //single event
    // Echo.private("order-dispatch.1").listen("OrderDispatchedEvent", (event) => {
    //     orderDispatch.value = true;
    //     order.value = event.order;
    // });

    //multiple events
    Echo.private("users.1").listen("OrderDispatchedEvent", (event) => {
        orderDispatch.value = true;
        order.value = event.order;
        delivered.value = false ;
                console.log(event);


    })
    .listen('OrderDeliveredEvent', (event) => {
        console.log(event);
        order.value = event.order
        delivered.value = true;
    });
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Order
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div
                        class="p-6 text-gray-900 dark:text-gray-100"
                        v-if="orderDispatch"
                    >
                        Order (# <span>{{ order.id }}</span
                        >) has been dispatched!
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div
                        class="p-6 text-gray-900 dark:text-gray-100"
                        v-if="delivered"
                    >
                        Order (# <span>{{ order.id }}</span
                        >) has been delived!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
