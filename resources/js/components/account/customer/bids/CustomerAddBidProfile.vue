<template>
    <div>
        <b-button
            :label="lang.add"
            icon-left="mdi mdi-mdi mdi-gavel mdi-24px"
            type="is-dark"
            @click="isBidModalActive = true"/>

        <b-modal
            v-model="isBidModalActive"
            full-screen
            scroll="keep">

            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ lang.add_bid }}</p>
                </header>
                <section class="modal-card-body">

                    <div class="columns">
                        <div class="column is-3"></div>
                        <div class="column is-6">
                            <div class="content box">
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.car">
                                            <b-autocomplete
                                                v-if="car_list.length > 0"
                                                v-model="name_car"
                                                :data="filteredCarArray"
                                                placeholder="Audi..."
                                                icon="magnify"
                                                field="mark.name"
                                                clearable
                                                open-on-focus
                                                @select="option => selected_car = (option ? option.id : '')">
                                                <template slot-scope="props">
                                                    {{ props.option.mark.name }} - {{ props.option.vin }}
                                                </template>
                                            </b-autocomplete>

                                            <customer-add-car-profile
                                                v-else
                                                :customer="customer"
                                                :marks="marks"
                                                :mark_models="mark_models"
                                                :transmissions="transmissions"
                                                :years="years"
                                                :lang="lang">
                                            </customer-add-car-profile>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.car_id ? lang.required + lang.car : '' }}
                                            </small>
                                        </template>
                                    </div>
                                    <div class="column">
                                        <b-field :label="lang.address">
                                            <b-autocomplete
                                                v-model="name_city"
                                                :data="filteredCityArray"
                                                placeholder="Киев..."
                                                icon="magnify"
                                                field="name"
                                                clearable
                                                open-on-focus
                                                group-field="city.name"
                                                @select="option => selected_city = (option ? option.id : '')">
                                                <template #empty>{{ lang.nothing_found }}</template>
                                            </b-autocomplete>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.city_id ? lang.required + lang.address : '' }}
                                            </small>
                                        </template>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.categories">
                                            <b-taginput
                                                expanded
                                                v-model="tags_categories"
                                                :data="filteredTags"
                                                autocomplete
                                                :allow-new="allowNew"
                                                :open-on-focus="openOnFocus"
                                                field="name"
                                                icon="label"
                                                group-field="category.name"
                                                :placeholder="lang.select"
                                                :close-on-select="closeOnSelect"
                                                :ellipsis="ellipsis"
                                                @typing="getFilteredTags">
                                            </b-taginput>
                                            <p class="control">
                                                <b-button>
                                                    <span class="mdi mdi-format-vertical-align-top"></span>
                                                </b-button>
                                            </p>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.category_ids ? lang.required + lang.categories : '' }}
                                            </small>
                                        </template>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.what_to_do">
                                            <b-input maxlength="400" type="textarea" v-model="description"></b-input>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.description ? lang.required + lang.what_to_do : '' }}
                                            </small>
                                        </template>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field class="file is-dark" :class="{'has-name': !!file}">
                                            <b-upload v-model="file" class="file-label" @change="onAttachmentChange">
                                                <span class="file-cta">
                                                    <b-icon class="file-icon" icon="upload"></b-icon>
                                                    <span class="file-label">Загрузить файл</span>
                                                </span>
                                                <span class="file-name" v-if="file">
                                                    {{ file.name }}
                                                </span>
                                            </b-upload>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <small>(pdf,png,jpeg,gif,txt)</small>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.desired_date">
                                            <b-datepicker
                                                v-model="desired_date"
                                                position="is-top-right"
                                                :placeholder="lang.select"
                                                icon="calendar-today"
                                                :min-datetime="new Date()">
                                            </b-datepicker>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field :label="lang.type">
                                            <b-switch
                                                type="is-danger"
                                                v-model="type"
                                                true-value="1"
                                                false-value="0">
                                                {{ lang.urgently }}
                                            </b-switch>
                                        </b-field>
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
                        @click="addBid"
                    />
                    <b-button
                        :label="lang.close"
                        @click="isBidModalActive = false"/>
                </footer>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "CustomerAddBidProfile",
    props: ['customer', 'cars', 'cities', 'categories', 'lang',
        'years', 'marks', 'mark_models', 'transmissions'],
    data() {
        return {
            name_car: '',
            name_city: '',
            selected_car: '',
            selected_city: '',
            description: '',
            desired_date: new Date(),
            type: false,
            isBidModalActive: false,
            car_id: '',
            city_id: '',
            isSelectOnly: false,
            allowNew: false,
            openOnFocus: true,
            closeOnSelect: true,
            ellipsis: false,
            tags_categories: [],
            category_ids: [],
            filteredTags: this.categories,
            car_list: this.cars,
            file: null,
            errors: [],
        }
    },

    mounted() {
        this.$root.$on('isAddNewCar', car => {
            if (car) {
                this.selected_car = car.id
                this.getCars();
            }
        });
    },

    computed: {
        filteredCarArray() {
            return this.car_list.filter((option) => {
                return option.mark.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.name_car.toLowerCase()) >= 0
            });
        },
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
        getFilteredTags(text) {
            this.filteredTags = this.categories.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(text.toLowerCase()) >= 0
            })
        },

        getCars() {
            axios.patch('/account/list-update-customer-cars', {
                customer_id: this.customer.id,
            }).then(r => {
                this.car_list = r.data.cars;
            });
        },

        addBid() {
            const config = {'content-type': 'multipart/form-data'}
            const formData = new FormData()
            formData.append('car_id', this.car_id)
            formData.append('customer_id', this.customer.id)
            formData.append('status_id', 1)
            formData.append('city_id', this.city_id)
            formData.append('description', this.description)
            formData.append('category_ids', this.category_ids)
            formData.append('desired_date', this.$luxon(this.desired_date.toISOString(), "yyyy-MM-dd"))
            formData.append('type', Number(this.type))
            formData.append('file', this.file)

            axios.post('store-customer-bid', formData, config).then(r => {
                this.isBidModalActive = false
                this.$buefy.notification.open({
                    message: this.lang.bids_created,
                    type: 'is-success',
                })
                this.$root.$emit('isAddNewBid', true);
                this.clearForm()
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        },

        onAttachmentChange(e) {
            this.file = e.target.files[0]
        },

        clearForm() {
            this.category_ids = []
            this.tags_categories = []
            this.description = ''
            this.desired_date = new Date()
            this.type = false
            this.file = null
        },

    },

    watch: {
        selected_car(val) {
            this.car_id = val
        },
        selected_city(val) {
            this.city_id = val
        },
        tags_categories() {
            this.category_ids = Object.keys(this.tags_categories).map(id => this.tags_categories[id].id);
        },
        type(val) {
            if (val == 1) {
                return this.type = true
            } else {
                return this.type = false
            }
        },
    },

}
</script>

<style scoped>

</style>
