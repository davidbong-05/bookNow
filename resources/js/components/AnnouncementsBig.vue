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
                <div v-if="announcements!=''">
                    <p v-for="announcement in announcements" class="row">
                        <span class="col-2">{{ formatDate (announcement.created_at)}}</span>
                        <span class="col"><b>{{ announcement.body }}</b></span>
                    </p>
                </div>
                <div v-else>
                    <p class="text-gray">No announcement yet...</p>
                </div>
            </div>
        </div>
        <br>
        <div class="text-white text-center mt-auto d-flex justify-content-center">
            Scroll Down to Start Booking
            <div class="chevron"></div>
            <div class="chevron"></div>
            <div class="chevron"></div>
        </div>
    </div>
</template>

<script>
import { ref,onMounted } from 'vue';
import moment from 'moment';
import { BIconMegaphone} from 'bootstrap-icons-vue';

    export default {
        props: ['bgImgUrl'],
        components: {
            BIconMegaphone,
        },
        setup(props) {
            const bgImg = { background: 'url(' + props.bgImgUrl + ') no-repeat center' }
            const announcements = ref('')
            onMounted(() => {
                axios.get('/api/announcements'
                ).then(res => {
                    announcements.value = res.data;
                }).catch((error) => {
                    console.log('Looks like there was a problem: \n', error);
                });
            })

            function formatDate(value) {
                return moment(value).format('Do MMMM YYYY, h:mm a');
            }

            return {
                bgImg, announcements, formatDate
            }
        },

    }
</script>
<style scoped>
.chevron {
    position: absolute;
    width: 28px;
    height: 8px;
    opacity: 0;
    transform: scale3d(0.5, 0.5, 0.5);
    animation: move 3s ease-out infinite;
}

.chevron:first-child {
    animation: move 3s ease-out 1s infinite;
}

.chevron:nth-child(2) {
    animation: move 3s ease-out 2s infinite;
}

.chevron:before,
.chevron:after {
    content: ' ';
    position: absolute;
    top: 0;
    height: 100%;
    width: 51%;
    background: #fff;
}

.chevron:before {
    left: 0;
    transform: skew(0deg, 30deg);
}

.chevron:after {
    right: 0;
    width: 50%;
    transform: skew(0deg, -30deg);
}

@keyframes move {
    25% {
        opacity: 1;

    }

    33% {
        opacity: 1;
        transform: translateY(30px);
    }

    67% {
        opacity: 1;
        transform: translateY(40px);
    }

    100% {
        opacity: 0;
        transform: translateY(55px) scale3d(0.5, 0.5, 0.5);
    }
}
</style>
