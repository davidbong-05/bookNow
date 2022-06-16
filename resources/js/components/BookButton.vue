<template>
    <a href="{{ route('booking.create', $facility->id) }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
        :title="title">

        <button type="submit" class="btn mt-1 w-100" :class="color" :disabled="disabled">Book Now</button>

    </a>
</template>

<script>

export default {
    props: [
        'status'
    ],
    data() {
        if(this.status == 0){
            return {
                disabled: false,
                title: "Click here to Book Now!",
                color: "btn-primary"
            };
        }
        else if (this.status == 1) {
            return {
                disabled: true,
                title: "Please log in first",
                color: "btn-secondary"
            };
        }
        else if (this.status == 2) {
            return {
                disabled: true,
                title: "Oops, it seems like you already reached your booking limit",
                color: "btn-secondary"
            };
        }
        else if (this.status == 3) {
            return {
                disabled: true,
                title: "Please come back on Monday",
                color: "btn-secondary"
            };
        }
    },
}
</script>
