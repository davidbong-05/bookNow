<template>
    <div id="slot">

        <div class="row">
            <small class="text-center" v-show="error['selectSlot']">{{ error['selectSlotMsg'] }}</small>
            <div class="col-9 ms-4">
                <span class="ms-2 me-5">Week {{ week }} </span>
            </div>
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
                    <td v-for="day in days" :class="checkSlot(getDate2(day),slot)">
                        <label v-if="checkSlot(getDate2(day), slot)=='empty'" :for="getDate2(day)+slot"
                            :class='isCheck(getDate2(day), slot)'>
                            <input type='checkbox' :value="{date:getDate2(day),time:slot}" :id="getDate2(day)+slot"
                                v-model="checkedSlot" />
                        </label>
                        <!-- @click="tick(getDate2(day) + slot)" -->
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>
<script>
import { toRef, ref, reactive,watch } from 'vue';
import moment from 'moment';

export default {
    props:[
        'pendingArr',
        'bookedArr',
    ],
    emits: ['update:modelValue'],
    setup(props, {emit}){

        const newDate = moment().add(1, 'w')
        const week = newDate.format('w of YYYY')
        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri']
        const slots = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '17:00', '18:00', '19:00', '20:00']
        const pendingArr = toRef(props,'pendingArr')
        const bookedArr = toRef(props, 'bookedArr')
        let pendingDate = ref('')
        let bookedDate = ref ('')

        const checkedSlot = ref([])
        const error = reactive({})

        function getDate(day) {
            return moment().day(day).add(1, 'w').format('DD/MM');
        }

        function getDate2(day) {
            return moment().day(day).add(1, 'w').format('YYYY-MM-DD');
        }

        watch(pendingArr, (newPendingArr) => {
            pendingDate.value=getPending();
        })

        watch(bookedArr,(newBookedArr)=>{
            bookedDate.value=getBooked();
        })

        function getPending() {
            let pending = []
            if (pendingArr.value!='') {
                Object.keys(pendingArr.value).forEach((key) => {
                    pending.push(pendingArr.value[key].date + pendingArr.value[key].time);
                })
            }
            return pending;
        }

        function getBooked() {
            let booked = []
            if (bookedArr.value!=''){
                Object.keys(bookedArr.value).forEach((key) => {
                    booked.push(bookedArr.value[key].date + bookedArr.value[key].time);
                })
            }
            return booked;
        }

        function checkSlot(date, slot){
            let check = date + slot + ':00';

            if (bookedDate.value.includes(check)){
                return 'booked';
            }
            else if (pendingDate.value.includes(check)){
                return 'pending';
            }
            else return 'empty';
        }

        watch(checkedSlot, (newCheckedSlot) => {
            if(checkedSlot.value.length>1){
                checkedSlot.value.splice(1)
                error['selectSlot'] = 'is-invalid';
                error['selectSlotMsg'] = 'Maximum 1 slot only';
            }else{
                error['selectSlot'] = 'is-valid';
                error['selectSlotMsg'] = null;
            }

            let value = checkedSlot.value;
            emit('update:modelValue',value);
        })

        function isCheck(date,time){
            if (checkedSlot.value.length > 0) {
                if (checkedSlot.value[0].date == date && checkedSlot.value[0].time == time){
                    return 'green';
                }
            }
        }

        return{
            pendingDate, bookedDate,
            week, days, getDate,getDate2,
            slots, checkSlot,
            checkedSlot,isCheck,
            error
        }
    }
}
</script>
<style scoped>
.table tbody tr *{
    padding: 0 !important;
    height: 2em;
}

#slot label {
    display: block;
    height: 100%;
}
#slot input {
    opacity: 0;
}
#slot .booked {
    background-color: #dc3545;
}

#slot .pending {
    background-color: #ffc107;
}

#slot .green {
    background-color: #28a745;
}

#slot .row small {
    color: crimson;
    animation: shake 0.8s;
    animation-iteration-count: 1;
}

@keyframes shake {

    10%,
    90% {
        transform: translate3d(-1px, 0, 0);
    }

    20%,
    80% {
        transform: translate3d(2px, 0, 0);
    }

    30%,
    50%,
    70% {
        transform: translate3d(-4px, 0, 0);
    }

    40%,
    60% {
        transform: translate3d(4px, 0, 0);
    }
}
</style>
