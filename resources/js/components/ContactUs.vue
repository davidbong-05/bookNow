<template>
    <footer class="footer mt-auto bg-gray" id="contactUs">
        <div class="container-fluid p-3 shadow-sm" style="background-color:#dfdfdf">

            <div class="row">
                <span v-show="!email.valid" class="alert alert-danger" name="alert" style="width: 100%">
                    <strong>{{ errorMsg }}</strong>
                </span>
                <p id="success"></p>
                <section class="col-8">
                    <h3>ENQUIRY FORM</h3>
                    <form method="post" action="" @submit.prevent="submit">
                        <div class="container">
                            <div class="form-floating mt-2">
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                    v-model="name" required />
                                <label for="name">Name</label>
                            </div>
                            <div class="form-floating mt-2">
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control"
                                    autocomplete="email" :class="error(email)" v-model="email.value" required />
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mt-2">
                                <input type="text" name="subject" id="subject" placeholder="Subject"
                                    class="form-control" v-model="subject" required />
                                <label for="subject">Subject</label>
                            </div>
                            <div class="form-floating mt-2">
                                <textarea name="message" class="form-control" rows="3" placeholder="Enquiry"
                                    id="textarea" v-model="message.text" :maxlength="message.maxlength"
                                    required></textarea>
                                <span class="counter">{{ message.text.length }} / {{ message.maxlength }}</span>
                                <label for="message">Enquiry</label>
                                <div class="mt-2">
                                    <input type="submit" value="Send Message" class="btn btn-primary" />
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="col">
                    <div class="row my-2">
                        <h3>CONTACT INFO</h3>
                        <div class="col container">
                            <div class="row">
                                <a href="#" class="text-decoration-none text-secondary">
                                    <BIconEnvelope />
                                    corporate@unimas.my
                                </a>
                            </div>
                            <div class="row">
                                <a href="#" class="text-decoration-none text-secondary">
                                    <BIconTelephone />
                                    +60 82 58 1000 | +60 82 58 1388
                                </a>
                            </div>
                            <div class="row">
                                <a href="#" class="text-decoration-none text-secondary">
                                    <BIconPrinter />
                                    Fax: +60 82 665 088
                                </a>
                            </div>
                            <div class="row">
                                <a href="#" class="text-decoration-none text-secondary">
                                    <BIconPin />
                                    UNIMAS, 94300 Kota Samarahan, Sarawak, Malaysia
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h3>FOLLOW US</h3>
                        <div>
                            <a href="#" class="text-decoration-none text-secondary me-2">
                                <BIconTwitter />
                                Twitter
                            </a>
                            <a href="#" class="text-decoration-none text-secondary me-2">
                                <BIconFacebook />
                                Facebook
                            </a>
                            <a href="#" class="text-decoration-none text-secondary me-2">
                                <BIconInstagram />
                                Instagram
                            </a>
                            <a href="#" class="text-decoration-none text-secondary">
                                <BIconLinkedin />
                                LinkedIn
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </footer>
</template>

<script>
import { BIconEnvelope, BIconTelephone, BIconPrinter,BIconPin, BIconTwitter,BIconFacebook, BIconInstagram, BIconLinkedin } from 'bootstrap-icons-vue';
var emailRegExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
export default {
    components: {
        BIconEnvelope,
        BIconTelephone,
        BIconPrinter,
        BIconPin,
        BIconTwitter,
        BIconFacebook,
        BIconInstagram,
        BIconLinkedin,
    },
    data: function () {
        return {
            name: '',
            email: {
                value: '',
                valid: true
            },
            subject: '',
            message: {
                text: '',
                maxlength: 255
            }
        };
    },
    methods: {
        // submit form handler
        submit: function () {
            axios.post('/enquiry-mail', {
                name: this.name,
                email: this.email.value,
                subject: this.subject,
                message: this.message.text,
            })
        },
        // validate by type and value
        validate: function (type, value) {
            if (type === "email") {
                this.email.valid = this.isEmail(value) ? true : false;
            }
        },
        // check for valid email address
        isEmail: function (value) {
            return emailRegExp.test(value);
        },
        error: function(field){
            if (field.value!=''){
                this.errorMsg ='Oopss, its look like you have some error(s) ...';
                return field.valid ? 'is-valid' : 'is-invalid';
            }
            else {
                return !field.valid ? 'is-invalid':'';
            }
        }

    },
    watch: {
        // watching nested property
        "email.value": function (value) {
            this.validate("email", value);
        }
    }
}
</script>
