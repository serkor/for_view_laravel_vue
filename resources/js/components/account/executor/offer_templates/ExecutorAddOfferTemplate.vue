<template>
    <div>
        <b-button
            :label="lang.add"
            icon-left="mdi mdi-note mdi-24px"
            type="is-dark"
            @click="isOfferTemplateModalActive = true"/>

        <b-modal
            v-model="isOfferTemplateModalActive"
            full-screen
            scroll="keep">
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ lang.modal_title }}</p>
                </header>
                <section class="modal-card-body">

                    <div class="columns">
                        <div class="column is-3"></div>
                        <div class="column is-6">
                            <div class="content box">
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.name">
                                            <b-input v-model="name"></b-input>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.name ? lang.required + lang.name : '' }}
                                            </small>
                                        </template>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.sum_part">
                                            <b-input v-model="sum_part"
                                                     type="text"
                                                     pattern="^([0-9]*[.])?[0-9]*$" min="0"
                                                     maxlength="10"
                                                     placeholder="0"
                                            ></b-input>
                                            <b-select :placeholder="lang.uah">
                                                <option selected value="UAH">{{ lang.uah }}</option>
                                            </b-select>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.sum_part ? lang.required + lang.sum_part : '' }}
                                            </small>
                                        </template>
                                    </div>
                                    <div class="column">
                                        <b-field :label="lang.sum_repair">
                                            <b-input v-model="sum_repair"
                                                     type="text"
                                                     pattern="^([0-9]*[.])?[0-9]*$" min="0"
                                                     maxlength="10"
                                                     placeholder="0"
                                            ></b-input>
                                            <b-select :placeholder="lang.uah">
                                                <option selected value="UAH">{{ lang.uah }}</option>
                                            </b-select>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.sum_repair ? lang.required + lang.sum_repair : '' }}
                                            </small>
                                        </template>
                                    </div>
                                    <div class="column">
                                        <b-field :label="lang.number_hours">
                                            <b-input v-model="number_hours"
                                                     type="text"
                                                     pattern="^([0-9]*[.])?[0-9]*$" min="0"
                                                     maxlength="5"
                                                     placeholder="0"
                                            ></b-input>
                                            <b-select :placeholder="lang.hours">
                                                <option selected value="UAH">{{lang.hours}}</option>
                                            </b-select>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.number_hours ? lang.required + lang.number_hours : '' }}
                                            </small>
                                        </template>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field :label="lang.description">
                                            <b-input maxlength="400" v-model="description" type="textarea"></b-input>
                                        </b-field>
                                        <template v-if="errors">
                                            <small class="is-danger validation_field">
                                                {{ errors.description ? lang.required + lang.description : '' }}
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
                        @click="addOfferTemplate"
                    />
                    <b-button
                        :label="lang.close"
                        @click="isOfferTemplateModalActive = false"/>
                </footer>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "ExecutorAddOfferTemplate",
    props: {
        executor: Object,
        lang: Object
    },

    data() {
        return {
            isOfferTemplateModalActive: false,
            name: '',
            sum_part: '',
            sum_repair: '',
            number_hours: '',
            description: '',
            errors: []
        }
    },

    methods: {
        addOfferTemplate() {
            axios.patch('/account/store-executor-offer-template', {
                executor_id: this.executor.id,
                name: this.name,
                sum_part: this.sum_part,
                sum_repair: this.sum_repair,
                number_hours: this.number_hours,
                description: this.description
            }).then(r => {
                this.$root.$emit('addNewOfferTemplate', true);
                this.isOfferTemplateModalActive = false
                this.$buefy.notification.open({
                    message: 'Добавлен!',
                    type: 'is-success'
                })
                this.isOfferTemplateModalActive = false
                this.clearForm()
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        },

        clearForm() {
            this.name = ''
            this.sum_part = ''
            this.sum_repair = ''
            this.number_hours = ''
            this.description = ''
        },

    }
}
</script>

<style scoped>

</style>

