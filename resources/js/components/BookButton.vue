<template>
    <a :href="button.route" data-bs-toggle="tooltip" data-bs-placement="bottom" :desc="button.desc">

        <button type="submit" class="btn mt-1 w-100" :class="button.color"
            :disabled="button.disabled">
            {{button.title}}
        </button>

    </a>
</template>

<script>
export default {
    props: [
        'status',
        'facilityId'
    ],
    setup(props){
        const button = {
            disabled:'',
            title:'',
            desc: '',
            color: '',
            route:'',
        }


        if (props.status == 0) {

            button.disabled = false,
            button.title = "Book Now",
            button.desc = "Click here to Book Now!",
            button.color = "btn-primary",
            button.route = "/facility/" + props.facilityId + "/book-form"
        }
        else if (props.status == 1) {

            button.disabled = true,
            button.title = "Login to Book ",
            button.desc = "Please log in first",
            button.color = "btn-secondary",
            button.route = "/login"
        }
        else if (props.status == 2) {

            button.disabled = true,
            button.title = "Max",
            button.desc = "Oops, it seems like you already reached your booking limit",
            button.color = "btn-secondary",
            button.route = "#"
        }
        else if (props.status == 3) {

            button.disabled = true,
            button.title = "Close",
            button.desc = "Please come back on Monday",
            button.color = "btn-secondary",
            button.route = "#"
        }

        return {
            button
        }
    }
}
</script>
