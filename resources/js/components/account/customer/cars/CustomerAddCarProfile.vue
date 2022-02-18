<template>
    <div>
        <b-button
            label="Добавить"
            icon-left="mdi mdi-mdi mdi-car mdi-24px"
            type="is-dark"
            @click="isCarModalActive = true"/>

        <b-modal
            v-model="isCarModalActive"
            full-screen
            scroll="keep">

            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ lang.add_car }}</p>
                </header>
                <section class="modal-card-body">

                    <div class="columns">
                        <div class="column is-3"></div>
                        <div class="column is-6">
                            <div class="content box">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="VIN:">
                                            <b-input
                                                @input="updateText(vin)"
                                                maxlength="17"
                                                type="text"
                                                v-model="vin">
                                            </b-input>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.vin ? lang.required + lang.vin : '' }}
                                            </small>
                                        </template>
                                    </div>
                                    <div class="column"></div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.mark">
                                            <b-autocomplete
                                                v-model="name_mark"
                                                :data="filteredMarkArray"
                                                placeholder="Audi..."
                                                icon="magnify"
                                                field="name"
                                                clearable
                                                open-on-focus
                                                @select="option => selected_mark = (option ? option.id : '')">
                                                <template #empty>{{ lang.nothing }}</template>
                                            </b-autocomplete>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.mark_id ? lang.required + lang.mark : '' }}
                                            </small>
                                        </template>
                                    </div>
                                    <div class="column">
                                        <b-field :label="lang.mark_model">
                                            <b-autocomplete
                                                v-model="name_mark_model"
                                                :data="filteredMarkModelArray"
                                                :disabled="disabled"
                                                placeholder="100..."
                                                icon="magnify"
                                                field="name"
                                                clearable
                                                open-on-focus
                                                @select="option => selected_mark_model = (option ? option.id : '')">
                                                <template #empty>{{ lang.nothing }}</template>
                                            </b-autocomplete>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.mark_model_id ? lang.required + lang.mark_model : '' }}
                                            </small>
                                        </template>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.transmission">
                                            <b-autocomplete
                                                v-model="name_transmission"
                                                :data="filteredTransmissionArray"
                                                placeholder="CVT..."
                                                icon="magnify"
                                                field="name"
                                                clearable
                                                open-on-focus
                                                @select="option => selected_transmission = (option ? option.id : '')">
                                                <template #empty>{{ lang.nothing }}</template>
                                            </b-autocomplete>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.transmission_id ? lang.required + lang.transmission : '' }}
                                            </small>
                                        </template>
                                    </div>
                                    <div class="column">
                                        <b-field :label="lang.year">
                                            <b-autocomplete
                                                v-model="name_year"
                                                :data="filteredYearArray"
                                                placeholder="1990..."
                                                icon="magnify"
                                                field="name"
                                                clearable
                                                open-on-focus
                                                @select="option => selected_year = (option ? option.id : '')">
                                                <template #empty>{{ lang.nothing }}</template>
                                            </b-autocomplete>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.year_id ? lang.required + lang.year : '' }}
                                            </small>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-3"></div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        :label="lang.add"
                        type="is-dark"
                        @click="addCar"
                    />
                    <b-button
                        :label="lang.close"
                        @click="isCarModalActive = false"/>
                </footer>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "CustomerAddCarProfile",
    props: {
        customer: Object,
        marks: Array,
        transmissions: Array,
        years: Array,
        lang: Object
    },

    data() {
        return {
            disabled: true,
            mark_models: [],
            name_mark: '',
            name_mark_model: '',
            name_transmission: '',
            selected_mark: '',
            selected_mark_model: '',
            selected_transmission: '',
            name_year: '',
            selected_year: '',
            isCarModalActive: false,
            vin: '',
            mark_id: '',
            mark_model_id: '',
            transmission_id: '',
            year_id: '',
            errors: []
        }
    },

    watch: {
        selected_mark(val) {
            this.mark_id = val
            this.getMarkModel(val)
        },
        selected_mark_model(val) {
            this.mark_model_id = val
        },
        selected_transmission(val) {
            this.transmission_id = val
        },
        selected_year(val) {
            this.year_id = val
        }
    },

    computed: {

        filteredMarkArray() {
            return this.marks.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.name_mark.toLowerCase()) >= 0
            });
        },

        filteredMarkModelArray() {
            return this.mark_models.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.name_mark_model.toLowerCase()) >= 0
            });
        },

        filteredTransmissionArray() {
            return this.transmissions.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.name_transmission.toLowerCase()) >= 0
            });
        },

        filteredYearArray() {
            return this.years.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.name_year.toLowerCase()) >= 0
            });
        },
    },

    methods: {
        updateText(val) {
            this.vin = val.toUpperCase();
        },

        getMarkModel(val) {
            this.disabled = false
            axios.patch('/account/get-customer-mark-model', {
                id: val,
            }).then(r => {
                this.mark_models = r.data
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        },

        addCar() {
            axios.patch('/account/store-customer-car', {
                vin: this.vin.toUpperCase(),
                mark_id: this.mark_id,
                mark_model_id: this.mark_model_id,
                transmission_id: this.transmission_id,
                year_id: this.year_id,
                customer_id: this.customer.id
            }).then(r => {
                this.isReviewModalActive = false
                this.$buefy.notification.open({
                    message: this.lang.car_added,
                    type: 'is-success'
                })
                this.$root.$emit('isAddNewCar', r.data.car);
                this.isCarModalActive = false
                this.clearForm()
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        },

        clearForm() {
            this.vin = ''
            this.mark_id = ''
            this.mark_model_id = ''
            this.transmission_id = ''
            this.year_id = ''
        },

    }
}
</script>

<style scoped>

</style>
