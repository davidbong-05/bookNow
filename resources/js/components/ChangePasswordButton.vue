<template>
        <a class="rounded-pill border
            border-primary px-4 py-2 text-decoration-none text-primary me-2" @click="openForm()">
            Change Password
        </a>
        <change-password-form v-if="isOpen==true" :user_id="user_id" v-model="isOpen"/>

</template>

<script>
import { ref } from 'vue';
export default {
    props: [
        'user_id'
    ],
    setup(){
        const isOpen = ref(false);

        function openForm(){
            isOpen.value=true;
        }


        return{
            isOpen, openForm,
        }
    }
}
</script>
