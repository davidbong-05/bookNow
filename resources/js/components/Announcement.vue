<template>
    <p class="row">
        <span class="col-2">{{ formatDate (announcement.created_at)}}</span>
        <span class="col"><b>{{ announcement.body }}</b></span>
    </p>
</template>

<script>
import moment from 'moment';

export default {
    props: ['announcement'],
    data() {
        return {};
    },
    methods: {
        formatDate(value) {
            return moment(value).format('Do MMMM YYYY, h:mm a')
        }
    },

}
</script>
