<template>
    <form id="msform" method="post" action="" @submit.prevent="submit" style="text-align: center;
    position: relative;
    margin-top: 10px;">
        <!-- progressbar -->
        <ul class="me-4" id="progressbar">
            <li class="active" id="date"><strong>Choose Date</strong></li>
            <li :class="[currStep() >=2 ? 'active':'']" id="contact"><strong>Contact Info</strong></li>
            <li :class="[currStep() >=3 ? 'active':'']" id="confirmation"><strong>Confirmation</strong></li>
            <li :class="[currStep() >=4 ? 'active':'']" id="finish"><strong>Finish</strong></li>
        </ul>

        <!--page 1-->
        <fieldset v-show="currStep() ==1">
            <div class="form-card">
                <div class="row">
                    <div class="col-3"><label class="form-label">Select Court:</label></div>
                    <div class="col-9">
                        <select class="form-control" :class="error['selectCourt']" id="court" name="courts_id"
                            @change="buildSlotField()" v-model="selectedCourt">
                            <option value="" disabled>
                                -- select court --
                            </option>
                            <option v-for="court in courts" :value="[court.id, court.name]">
                                {{ court.name }}
                            </option>
                        </select>
                    </div>
                    <small class="text-center" v-show="error['selectCourtMsg']">{{ error['selectCourtMsg'] }}</small>
                </div>
                <!-- /row -->
                <br />
                <div class="row">
                    <div class="col-3"><label>Choose Your Slot: </label></div>
                    <small class="text-center" v-show="error['selectSlot']">{{ error['selectSlotMsg'] }}</small>
                </div>

                <!-- Calendar -->
                <select-slot-field v-if="selectedCourt!=''" :pendingArr="pendingArr" :bookedArr="bookedArr"
                    v-model="selectedSlot">
                </select-slot-field>

                <div class="row indicator justify-content-end">
                    <div class='box booked ms-2 me-2'></div> Not Available
                    <div class='box pending ms-2 me-2'></div> Pending
                    <div class='box empty ms-2  me-2'></div> Available
                </div>

            </div>
            <!-- /form-card -->
            <input type="button" name="next" class="next action-button" value="Next Step" @click="step2()" />
        </fieldset>

        <!--page 2-->
        <fieldset v-show="currStep() ==2">
            <div class="form-card">
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">User ID:</label>
                    </div>
                    <div class="col-9 big">{{ id }}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">Name:</label>
                    </div>
                    <div class="col-9 big">{{ name }}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">Faculty/Department:</label>
                    </div>
                    <div class="col-9 big">{{ faculty }}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">Email:</label>
                    </div>
                    <div class="col-9 big">{{ email }}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">Mobile No.:</label>
                    </div>
                    <div class="col-9 big">{{ mobile }}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">Booking Purpose: </label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" :class="error['bookingPurpose']" id="remark" name="remark"
                            type="text" placeholder="e.g. Club Activity" required v-model="bookingPurpose">
                    </div>
                    <small class="text-center" v-show="error['bookingPurposeMsg']">{{ error['bookingPurposeMsg']
                        }}</small>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button-previous" value="Previous"
                @click="step1()" /> <input type="button" name="next" class="next action-button" value="Next Step"
                @click="step3()" />
        </fieldset>

        <!--page 3-->
        <fieldset v-show="currStep() ==3">
            <div class="form-card">
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Court: </label>
                    </div>
                    <div class="col-9 big">
                        {{ selectedCourt[1] }}
                    </div>
                </div>
                <div class="row mb-2">
                    <small class="text-center" v-show="error['hackerMsg']">{{ error['hackerMsg'] }}</small>
                    <div class="col-3">
                        <label class="form-label">Date: </label>
                    </div>
                    <div class="col-9 big" v-if="selectedSlot!=''">{{ selectedSlot[0].date }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Choosen Slot: </label>
                    </div>
                    <div class="col-9 big" v-if="selectedSlot!=''">{{ selectedSlot[0].time }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">User ID: </label>
                    </div>
                    <div class="col-9 big">
                        {{ id }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Name: </label>
                    </div>
                    <div class="col-9 big">
                        {{ name }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Faculty/Department: </label>
                    </div>
                    <div class="col-9 big">
                        {{ faculty }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Email: </label>
                    </div>
                    <div class="col-9 big">
                        {{ email }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Mobile No.: </label>
                    </div>
                    <div class="col-9 big">
                        {{ mobile }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Booking Purpose: </label>
                    </div>
                    <div class="col-9 big">
                        {{ bookingPurpose }}
                    </div>
                </div>
                <div class="row" id="ep">
                </div>

                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Fee: </label>
                    </div>
                    <div class="col-9 big">
                        RM 0.00
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="text-center">
                        <input type="checkbox" :class="error['tnc']" name="tnc" id="tnc" value="agree"
                            placeholder="I Agree" required v-model="tnc">
                        <label class="ms-2" for="tnc">I Agree to <a href='#'>Terms & Conditions</a></label>
                    </div>
                    <small class="text-center" v-show="error['tncMsg']">{{ error['tncMsg'] }}</small>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button-previous" value="Previous"
                @click="step2()" /> <input type="submit" id="confirm" class="action-button" value="Confirm" />
        </fieldset>

        <!--page 4-->
        <fieldset v-show="currStep() ==4">
            <div class="form-card" v-if="bookingId==''">
                <h2 class="fs-title text-center">Oops, something when wrong...</h2> <br><br>
                <div class="row justify-content-center">
                    <div class="col-3"> <img src="https://img.icons8.com/cotton/344/sad.png" class="fit-image">
                    </div>
                </div>
                <br><br>
                <div class="row justify-content-center">
                    <div class="col-7 text-center">
                        <h5>Please try again later...</h5>
                    </div>
                </div>
            </div>
            <div class="form-card" v-else-if="bookingId === 'duplicated'">
                <h2 class="fs-title text-center">Oops, someone is a head of you</h2> <br><br>
                <div class="row justify-content-center">
                    <div class="col-3"> <img src="https://img.icons8.com/cotton/344/sad.png" class="fit-image">
                    </div>
                </div>
                <br><br>
                <div class="row justify-content-center">
                    <div class="col-7 text-center">
                        <h5>Please refresh page and select a different slot ...</h5>
                    </div>
                </div>
            </div>
            <div class="form-card" v-else>
                <h2 class="fs-title text-center">Success !</h2> <br><br>
                <div class="row justify-content-center">
                    <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                    </div>
                </div>
                <br><br>
                <div class="row justify-content-center">
                    <div class="col-7 text-center">
                        <h5>We Will Process Your Request Soon</h5>
                        <h6>Your Booking ID is
                            #{{ bookingId }}
                        </h6>
                    </div>
                </div>
            </div>
            <a href="/">
                <button type="button" class="btn btn-primary mb-4">Home</button>
            </a>
        </fieldset>
    </form>
</template>

<script>
import { ref, reactive } from 'vue'
import moment from 'moment';
import SelectSlotField from './SelectSlotField.vue'
export default {
    props:[
        'user',
        'courts'
    ],
    components: {
        SelectSlotField
    },
    setup(props){
        const step = ref(1)
        const id = props.user.id
        const name = props.user.name
        const email = props.user.email
        const faculty = props.user.faculty
        const mobile = props.user.mobileNum
        const selectedCourt = ref('')
        const selectedSlot = ref([{date:'',time:''}])
        const bookingPurpose = ref('')
        const tnc = ref(false)
        const bookingId = ref('')
        const validFirstDate = moment().day('Monday').add(1, 'w').format('YYYY-MM-DD');
        const validLastDate = moment().day('Friday').add(1, 'w').format('YYYY-MM-DD');

        const error = reactive({})

        const pendingArr = ref('')
        const bookedArr = ref('')

        function buildSlotField(){

            axios.post('/api/bookings/pending', { id: selectedCourt.value[0] }
            ).then(res => {
                this.pendingArr=res.data.data
            }).catch((error) => {
                console.log('Looks like there was a problem: \n', error);
            });

            axios.post('/api/bookings/booked', { id: selectedCourt.value[0] }
            ).then(res => {
                this.bookedArr = res.data.data
            }).catch((error) => {
                console.log('Looks like there was a problem: \n', error);
            });
        }
        function currStep(){
            return step.value;
        }
        function step1() {
            step.value = 1;
        }
        function step2() {
            if(selectedCourt.value === ''){
                error['selectCourt'] = 'is-invalid';
                error['selectCourtMsg'] = 'Must select a court';
            }
            else {
                error['selectCourt'] = 'is-valid';
                error['selectCourtMsg'] = null;
            }
            if(selectedSlot.value!=''){
                if (selectedSlot.value[0].date === '' || selectedSlot.value[0].time === '') {
                    error['selectSlot'] = 'is-invalid';
                    error['selectSlotMsg'] = 'Must select a slot';
                }
                else {
                    error['selectSlot'] = 'is-valid';
                    error['selectSlotMsg'] = null;
                }
            }
            else {
                error['selectSlot'] = 'is-invalid';
                error['selectSlotMsg'] = 'Must select a slot';
            }

            if (error['selectCourt'] === 'is-valid' && error['selectSlot'] === 'is-valid'){
                step.value=2;
            }
        }
        function step3() {
            if (bookingPurpose.value === '') {
                error['bookingPurpose'] = 'is-invalid';
                error['bookingPurposeMsg'] = 'Must input a booking purpose';
            }
            else {
                error['bookingPurpose'] = 'is-valid';
                error['bookingPurposeMsg'] = null;
                step.value = 3;
            }
        }
        function submit() {
            if (tnc == false) {
                error['tnc'] = 'is-invalid';
                error['tncMsg'] = 'Must agree to our Term and Condition';
            } else {
                if (moment(this.selectedSlot[0].date).isAfter(validLastDate) || moment(this.selectedSlot[0].date).isBefore(validFirstDate)){
                    error['hacker'] = 'is-invalid';
                    error['hackerMsg'] = 'Please select a proper date';
                }
                else {
                        axios.post('/facility/book', {
                            user_id: this.id,
                            courts_id: this.selectedCourt[0],
                            remark: this.bookingPurpose,
                            date: this.selectedSlot[0].date,
                            time: this.selectedSlot[0].time
                        }).then(res => {
                            this.bookingId = res.data;
                            step.value = 4;
                        }).catch((error) => {
                            console.log('Looks like there was a problem: \n', error);
                        });
                }
            }
        }
        return{
            currStep,
            id,name,email,faculty,mobile,
            selectedCourt,selectedSlot,bookingPurpose,tnc,
            step1,
            step2,
            step3,
            submit, bookingId,
            error,
            buildSlotField,pendingArr, bookedArr
        }
    }
}
</script>
<style scoped>

#msform {
    text-align: center;
    position: relative;
    margin-top: 10px;
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative;
}

#msform fieldset {
    background: white;
    border: 0 none;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative;
}

#msform fieldset .form-card {
    text-align: left;
    color: #000000;
    font-weight: 700;
}
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #000000;
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative;
}

#progressbar #date:before {
    font-family: FontAwesome;
    content: "\f073";
}

#progressbar #contact:before {
    font-family: FontAwesome;
    content: "\f007";
}

#progressbar #confirmation:before {
    font-family: FontAwesome;
    content: "\f15c";
}

#progressbar #finish:before {
    font-family: FontAwesome;
    content: "\f00c";
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

#progressbar li:after {
    content: "";
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #ff0063;
}
#msform .action-button {
    width: 100px;
    background: #ff0063;
    font: inherit;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 10px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #ff0063;
}

#msform .action-button-previous {
    width: 100px;
    background: #444444;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 10px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .big {
    text-transform: uppercase !important;
    font-weight: 900px;
}

#msform small{
    color: crimson;
    animation: shake 0.8s;
    animation-iteration-count: 1;
}

#msform fieldset .booked {
    background-color: #dc3545;
}

#msform fieldset .pending {
    background-color: #ffc107;
}

.indicator {
    font-weight: lighter;
    color: #616161;
}

.box {
    height: 1em;
    width: 1.5em;
    margin-top: 0.3em;
    border: 1px solid black;
    border-radius: 2px;
    clear: both;
}

.fit-image {
    width: 100%;
    -o-object-fit: cover;
    object-fit: cover;
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
