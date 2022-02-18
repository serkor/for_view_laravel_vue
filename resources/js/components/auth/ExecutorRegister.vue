<template>
    <div>

        <div class="columns">
            <div class="column">
                <b-field :label="lang.long_name">
                    <b-input
                        v-model="name"
                        autocomplete="name"
                        placeholder="АвтоТрейд....">
                    </b-input>
                    <template v-if="errors"  #message>
                        <small class="is-danger validation_field">
                            {{ errors.name ? lang.required + lang.name : '' }}
                        </small>
                    </template>
                </b-field>
            </div>
            <div class="column">
                <b-field :label="lang.city_id">
                    <b-autocomplete
                        v-model="name_city"
                        :data="filteredCityArray"
                        placeholder="Киев..."
                        icon="magnify"
                        field="name"
                        clearable
                        open-on-focus
                        group-field="city.name"
                        @select="option => city_id = (option ? option.id : '')">
                        <template #empty>{{ lang.nothing_found }}</template>
                    </b-autocomplete>
                    <template v-if="errors"  #message>
                        <small class="is-danger validation_field">
                            {{ errors.city_id ? lang.required + lang.city_id : '' }}
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
                        type="tel"
                        v-mask="'380#########'"
                        placeholder="38099999....."
                        autocomplete="phone">
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
                        autocomplete="email"
                        placeholder="info@autotrade....">
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
                <b-button type="is-dark"
                          @click="sendData"
                          v-if="agree">
                    {{ lang.register }}
                </b-button>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "ExecutorRegister",
    props: ['lang', 'cities'],
    data() {
        return {
            name_city: '',
            role_id: 2,
            agree: true,
            city_id: '',
            name: '',
            phone: '',
            email: '',
            password: '',
            repeat_password: '',
            errors: [],
        }
    },

    computed: {
        filteredCityArray() {
            return this.cities.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.name_city.toLowerCase()) >= 0
            });
        },
    },

    methods: {
        sendData() {
            axios.post('/register', {
                role_id: this.role_id,
                name: this.name,
                city_id: this.city_id,
                phone: this.phone,
                email: this.email,
                password: this.password,
                password_confirmation: this.repeat_password,
            }).then(r => {
                this.$buefy.notification.open({
                    message: this.lang.message_is_send,
                    type: 'is-success'
                })
                location.href = '/account/executor-profile'
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        }
    }
}
</script>

<style scoped>

</style>
