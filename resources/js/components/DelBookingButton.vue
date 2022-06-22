<template>
    <a @click="cancel()" class="text-danger"><b-icon-trash/></a>
</template>

<script>

import { BIconTrash } from 'bootstrap-icons-vue';
import swal from 'sweetalert';

export default {
    props: [
        'bookingId',
    ],
    components:{
        BIconTrash
    },
    setup(props){
        function cancel(){
            swal({
                title: "Are you sure?",
                text: "Once confirmed, you will not be able to change back!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willChange) => {
                    if (willChange) {
                        axios.patch('/myBooking/' + props.bookingId, {
                            status: 'Canceled',
                        }).then(res => {
                            swal("Booking Canceled", {
                                icon: "success",
                            });
                            window.location.reload();
                        }).catch((error) => {
                            console.log('Looks like there was a problem: \n', error);
                        });

                    } else {
                        swal("Nothing changed");
                    }
                });
        }
        return{
            cancel,
        }
    }
}
</script>
