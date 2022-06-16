<template>
    <h4 class="text-center">
        <BIconMegaphone /> ANNOUNCEMENT
    </h4>
    <div class="container" style="
    width: 100%;
    -ms-overflow-style: none;
    scrollbar-width: none;
    ">
        <div v-if="announcements">
            <announcement v-for="announcement in announcements" :announcement="announcement"></announcement>
        </div>
        <div v-else>
            <p class="text-gray">No announcement yet...</p>
        </div>
    </div>
</template>

<script>
import { BIconChevronDoubleDown, BIconMegaphone} from 'bootstrap-icons-vue';

    export default {
        components: {
            BIconChevronDoubleDown,
            BIconMegaphone,
        },
        data() {
            return {};
        },
        mounted() {
            axios.get('/api/announcements').then(res => {
                this.announcements = res.data
            })
        }
    }
</script>
