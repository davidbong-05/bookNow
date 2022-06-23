<template>
    <div class="card bg-dark text-white rounded my-2 mx-4" style="width: 20rem; height :15rem">
        <img :src="facility.image" class="card-img" alt="facility_photo" style="width: 20rem; height :15rem" loading="lazy">
        <div class="card-img-overlay text-center">
            <h5 class="card-title" style="text-transform:uppercase; margin-top:40%;">
                {{ facility.name }}
            </h5>
        </div>
    </div>
</template>

<script>

export default {
    props: [
        'facility'
    ],
    data() {
        return {};
    },
}
</script>
