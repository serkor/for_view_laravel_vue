<template>
    <div>
        <div class="columns">
            <div class="column">
                <b-field :label="lang.name">
                    <b-input
                        v-model="name"
                        autocomplete="name"
                        placeholder="Иван....">
                    </b-input>
                    <template v-if="errors"  #message>
                        <small class="is-danger validation_field">
                            {{ errors.name ? lang.required + lang.name : '' }}
                        </small>
                    </template>
                </b-field>
            </div>
            <div class="column">
                <b-field :label="lang.surname">
                    <b-input
                        v-model="surname"
                        placeholder="Иванов...."
                        autocomplete="surname">
                    </b-input>
                    <template v-if="errors"  #message>
                        <small class="is-danger validation_field">
                            {{ errors.surname ? lang.required + lang.surname : '' }}
                        </small>
                    </template>
                </b-field>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <b-field :label="lang.phone">
                    <b-input
                        v-model="phone"
                        pattern="^([0-9]*[.])?[0-9]*$"
                        min="0"
                        maxlength="12"
                        autocomplete="phone"
                        type="tel"
                        v-mask="'380#########'"
                        placeholder="38099999.....">
                    </b-input>
                    <template v-if="errors"  #message>
                        <small class="is-danger validation_field">
                            {{ errors.phone ? lang.required + lang.phone : '' }}
                        </small>
                    </template>
                </b-field>
            </div>
            <div class="column">
                <b-field :label="lang.email">
                    <b-input
                        v-model="email"
                        placeholder="ivan.ivanov@gmail...."
                        autocomplete="email">
                    </b-input>
                    <template v-if="errors"  #message>
                        <small class="is-danger validation_field">
                            {{ errors.email ? lang.required + lang.email : '' }}
                        </small>
                    </template>
                </b-field>
            </div>
        </div>


        <div class="columns">
            <div class="column">
                <b-field :label="lang.password">
                    <b-input
                        v-model="password"
                        password-reveal
                        type="password"
                        autocomplete="password">
                    </b-input>
                    <template #message>
                        <div>{{ lang.message_pass_8 }}</div>
                    </template>
                    <template v-if="errors"  #message>
                        <small class="is-danger validation_field">
                            {{ errors.password ? lang.required + lang.password : '' }}
                        </small>
                    </template>
                </b-field>
            </div>
            <div class="column">
                <b-field :label="lang.repeat_password">
                    <b-input
                        v-model="repeat_password"
                        password-reveal
                        type="password"
                        autocomplete="repeat_password">
                    </b-input>
                </b-field>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <b-field>
                    <b-checkbox v-model="agree">
                        {{ lang.agree }}
                    </b-checkbox>
                </b-field>
            </div>
            <div class="column">
                <div class="buttons">
                    <b-button type="is-dark"
                              @click="sendData"
                              v-if="agree">
                        {{ lang.register }}
                    </b-button>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "CustomerRegister",
    props: ['lang'],
    data() {
        return {
            role_id: 3,
            agree: true,
            name: '',
            surname: '',
            phone: '',
            email: '',
            password: '',
            repeat_password: '',
            errors: [],
        }
    },
    methods:{
        sendData(){
            axios.post('/register', {
                role_id: this.role_id,
                name: this.name,
                surname: this.surname,
                phone: this.phone,
                email: this.email,
                password: this.password,
                password_confirmation: this.repeat_password,
            }).then(r => {
                this.$buefy.notification.open({
                    message: this.lang.message_is_send,
                    type: 'is-success'
                })
                location.href = '/account/customer-profile'
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        }
    }
}
</script>

<style scoped>

</style>
