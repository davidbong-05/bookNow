<template>
    <div class="d-flex align-items-center" style="background-color: rgb(242, 132, 158, 0.80);">
        <div class=" h2 ms-3 me-1">
            <BIconMegaphone />
        </div>
        <div v-if="announcements!=''">
            <Vue3Marquee :duration="20" :pause-on-hover="true" :clone="true">
                <div v-for="announcement in announcements" class="ms-4 me-4" style="display:inline-block;">
                    <span class="col-2 me-2">{{ formatDate (announcement.created_at)}} >></span>
                    <span class="col"><b>{{ announcement.body }}</b></span>
                </div>
            </Vue3Marquee>
        </div>
        <div v-else>
            <p class="text-gray">No announcement yet...</p>
        </div>
    </div>
</template>

<script>
import { ref,onMounted } from 'vue';
import moment from 'moment';
import { BIconMegaphone } from 'bootstrap-icons-vue';
import { Vue3Marquee } from 'vue3-marquee'
import 'vue3-marquee/dist/style.css'

    export default {
        props: ['bgImgUrl'],
        components: {
            BIconMegaphone,
            Vue3Marquee,
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
            return moment(value).format('D MMMM YYYY, h:mm a');
        }

        return {
            bgImg, announcements, formatDate
        }
    },

}
</script>
