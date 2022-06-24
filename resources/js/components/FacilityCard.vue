<template>
    <div class="card bg-dark text-white rounded my-3 mx-3 button" style="width: 20rem; height :15rem">
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
<style scoped>
.button{
    transition: transform 0.1s ease-out, box-shadow;
}

.button:hover{
    box-shadow: -6px 6px 0 0 #ff0063;
}

.button:active{
    box-shadow: 0 0 0 0 #ff0063;
    transform: translateX(-6px) translateY(6px);
}
</style>
