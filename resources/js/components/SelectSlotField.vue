<template>
    <div class="col-9 ms-4">
        <span class="ms-2 me-5">Week {{ week }} </span>
        <div v-for="booked in bookedArr">{{ booked.id }}</div>
    </div>
    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>Slot</th>
                <th v-for="day in days">{{day}}<br>{{ getDate(day) }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="slot in slots">
                <th class="table-light">{{slot}}</th>
                <!-- <td v-for="day in days" :class="checkSlot(day,slot)">{{ checkSlot(day, slot) }}</td> -->
            </tr>
        </tbody>
    </table>
</template>
<script>
import moment from 'moment';

export default {
    props:[
        'pendingArr',
        'bookedArr'
    ],
    setup(){
        const newDate = moment().add(1, 'w')
        const week = newDate.format('w of YYYY')
        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri']
        const slots = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '17:00', '18:00', '19:00', '20:00'];

        function getDate(day){
            return moment().day(day).add(1, 'w').format('DD/MM');
        }

        function checkSlot(day, slot){

            // props.bookedArr.some(function (day, slot) {
            //     if (props.bookedArr.date == day && props.bookedArr.time == slot ){
            //         return 'booked'
            //     }
            // })
        }

        return{
            week, days, getDate,
            slots,checkSlot

        }
    }
}
</script>
