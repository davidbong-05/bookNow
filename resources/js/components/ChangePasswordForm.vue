<template>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h2 class="text-xl font-bold mb-6">Change Password</h2>
        </div>
        <div class="card-body">
            <form method="POST" @submit.prevent="submit" id="pform">
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" :class="error['password']"
                            name="password" required autocomplete="new-password" v-model="password">
                        <button id="toggle-password" type="button" class="d-none">
                        </button>

                    </div>
                    <small class="text-center" v-show="error['password']">{{ error['passwordMsg'] }}</small>
                </div>
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm
                        Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" :class="error['confirm']"
                            name="password_confirmation" required autocomplete="new-password" v-model="confirm">
                    </div>
                    <small class="text-center" v-show="error['confirm']">{{ error['confirmMsg'] }}</small>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <a class="btn btn-secondary" @click="closeForm()">
                            Cancel
                        </a>

                        <button type="submit" class="ms-2 btn btn-danger">
                            Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { ref,reactive,watch } from 'vue';
export default {
    props: [
        'user_id'
    ],
    emits: ['update:modelValue'],
    setup( props ,{emit}) {

        const keyRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/g
        const password = ref('')
        const confirm = ref('')
        const error = reactive({})

        function closeForm() {
            emit('update:modelValue', false);
        }

        watch(password, (newPassword) => {
            if(password.value==""){
                error['password'] = 'is-invalid';
                error['passwordMsg'] = 'Password must not be empty';
            }
            else if(password.value.match(keyRegex) === null){
                error['password'] = 'is-invalid';
                error['passwordMsg'] = 'Password must contain';
                if (password.value.match(/.*?[a-z]/g)===null){
                    error['passwordMsg'] = error['passwordMsg']+' at least 1 LOWER case;';
                }
                if (password.value.match(/.*?[A-Z]/g) === null) {
                    error['passwordMsg'] = error['passwordMsg'] + ' at least 1 UPPER case;';
                }
                if (password.value.match(/.*?[0-9]/g) === null) {
                    error['passwordMsg'] = error['passwordMsg'] + ' at least 1 DIGIT;';
                }
                if (password.value.match(/.*?[#?!@$ %^&*-]/g) === null) {
                    error['passwordMsg'] = error['passwordMsg'] + ' at least 1 SYMBOL(#?!@$ %^&*-);';
                }
                if (password.value.length < 8) {
                    error['passwordMsg'] = error['passwordMsg'] + ' is too short; at least 8 character;';
                }
            }
            else{
                error['password'] = 'is-valid';
                error['passwordMsg'] = null;
            }
        })

        watch(confirm, (newConfirm) => {
            if (confirm.value == "") {
                error['confirm'] = 'is-invalid';
                error['confirmMsg'] = 'Confirm Password must not be empty';
            }
            else if(confirm.value!=password.value){
                error['confirm'] = 'is-invalid';
                error['confirmMsg'] = 'Confirm Password not same';
            }
            else {
                error['confirm'] = 'is-valid';
                error['confirmMsg'] = null;
            }
        })

        function submit(){
            axios.patch('/profile/'+props.user_id, {
                password: this.password,
                password_confirmation: this.confirm
            }).then(res => {
                console.log(res.data);
            }).catch((error) => {
                console.log('Looks like there was a problem: \n', error);
            });
        }

        return {
            password,confirm,error,
            closeForm,
            submit,
        }
    }
}
</script>
<style scoped>
.card{
    position:absolute;
    z-index:2;
    margin: 30% 0 0 30%;
    width: 40em;
}

#pform .row small {
    color: crimson;
}
</style>
