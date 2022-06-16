<template>
    <form id="msform" method="post" action="" @submit.prevent="submit" style="text-align: center;
    position: relative;
    margin-top: 10px;">
        <!-- progressbar -->
        <ul class="me-4" id="progressbar">
            <li class="active" id="date"><strong>Choose Date</strong></li>
            <li :class="[ step>=2 ? 'active':'']" id="contact"><strong>Contact Info</strong></li>
            <li :class="[ step>=3 ? 'active':'']" id="confirmation"><strong>Confirmation</strong></li>
            <li :class="[ step>=4 ? 'active':'']" id="finish"><strong>Finish</strong></li>
        </ul>

        <!--page 1-->
        <fieldset v-show="step==1">
            <div class="form-card">
                <div class="row">
                    <div class="col-3"><label class="form-label">Select Court:</label></div>
                    <div class="col-9">
                        <select class="form-control" id="court" name="courts_id" required v-model="selectedCourt">
                            <option value="" disabled>
                                -- select court --
                            </option>
                            <option v-for="court in courts" :value="[court.id, court.name]">
                                {{ court.name }}
                            </option>
                        </select>
                    </div>
                    <small id="courtErr"></small>
                </div>
                <!-- /row -->
                <br />
                <div class="row">
                    <div class="col-3"><label>Choose Your Slot: </label></div>
                    <small id="slotErr"></small>
                </div>

                <!-- Calendar -->
                <div id="slot"></div>

                <div class="row indicator justify-content-end">
                    <div class='box red ms-2 me-2'></div> Not Available
                    <div class='box yellow ms-2 me-2'></div> Pending
                    <div class='box white ms-2  me-2'></div> Available
                </div>

            </div>
            <!-- /form-card -->
            <input type="button" name="next" class="next action-button" value="Next Step" @click="step2()" />
        </fieldset>

        <!--page 2-->
        <fieldset v-show="step==2">
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
                        <input class="form-control" id="remark" name="remark" type="text"
                            placeholder="e.g. Club Activity" required v-model="bookingPurpose">
                    </div>
                    <small id="remarkErr"></small>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button-previous" value="Previous"
                @click="step1()" /> <input type="button" name="next" class="next action-button" value="Next Step"
                @click="step3()" />
        </fieldset>

        <!--page 3-->
        <fieldset v-show="step==3">
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
                    <div class="col-3">
                        <label class="form-label">Date: </label>
                    </div>
                    <div class="col-9 big" id="c2"></div>
                    <div id="inputDate"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label class="form-label">Choosen Slot: </label>
                    </div>
                    <div class="col-9 big" id="c3"></div>
                    <div id="inputSlot"></div>
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
                    <div class="tc">
                        <input type="checkbox" name="tnc" id="tnc" value="agree" placeholder="I Agree" required
                            v-model="tnc">
                        <label for="tnc">I Agree to <a href='#'>Terms & Conditions</a></label>
                    </div>
                    <small id="tncErr"></small>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button-previous" value="Previous"
                @click="step2()" /> <input type="submit" id="confirm" class="action-button" value="Confirm" />
        </fieldset>
    </form>
</template>

<script>
import { ref } from 'vue'
export default {
    props:[
        'user',
        'courts'
    ],
    components: {
    },
    setup(props){
        const step = ref(1)
        const id = props.user.id
        const name = props.user.name
        const email = props.user.email
        const faculty = props.user.faculty
        const mobile = props.user.mobileNum
        const selectedCourt = ref('')
        const selectedSlot = ref('')
        const bookingPurpose = ref('')
        const tnc = ref(false)

        function submit() {
            axios.post('/facility/book', {
                name: name,
                email: email.value,
                subject: subject,
                message: message.text,
            }).then()
        }
        function error(field) {
            if (field.error == true) {
                return true
            }
            else {
                return false
            }
        }
        function step1() {
            selectedCourt.error=true;
            step.value = 1;
        }
        function step2() {
            step.value = 2;
        }
        function step3() {
            step.value = 3;
        }
        return{
            step,
            id,
            name,
            email,
            faculty,
            mobile,
            selectedCourt,
            selectedSlot,
            bookingPurpose,
            tnc,
            submit,
            step1,
            step2,
            step3,
            error,
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

#msform .tc {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 0.2em;
}

#msform .tc input,
#msform .tc label {
    margin: 0;
}

#msform .tc input {
    width: 10%;
}

#msform .big {
    text-transform: uppercase !important;
    font-weight: 900px;
}
</style>
