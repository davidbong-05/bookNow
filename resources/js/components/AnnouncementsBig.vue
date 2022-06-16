<template>
    <div class="d-flex flex-column justify-content-center py-5" :style="bgImg"
        style="background-size: cover; height:43rem">
        <div class="container border border-rounded" style="background-color: rgb(242, 132, 158, 0.80);
        color: black;
        border-radius: 10px;
        width: 100%;
        height: 100%;
        padding: 20px;">
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
        </div>
        <br>
        <div class="text-white text-center mt-auto up-down">
            <BIconChevronDoubleDown />
            Scroll Down to Start Booking
            <BIconChevronDoubleDown />
        </div>
    </div>
</template>

<script>
import { BIconChevronDoubleDown, BIconMegaphone} from 'bootstrap-icons-vue';

    export default {
        props: ['bgImgUrl'],
        components: {
            BIconChevronDoubleDown,
            BIconMegaphone,
        },
        data() {
            return {
                bgImg: { backgroundImage: 'url('+this.bgImgUrl+')' },
                announcements: [],
            };
        },
        mounted() {
            axios.get('/api/announcements').then(res => {
                this.announcements = res.data
            })
        }
    }
</script>
