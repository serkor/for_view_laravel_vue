<template>
    <div>
        <h4 class="subtitle is-4">
            <span class="mdi mdi-comment-account-outline"></span> {{ lang.offers }}
            <b-tag size="is-medium" rounded>{{ total }}</b-tag>
        </h4>
        <div class="list-group">
            <div class="item-offer mb-5" v-for="offer in offers" :key="offer.id">
                <div class="box p-5">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-9">
                                <h4 class="subtitle is-4">
                                    <a :href="`/executor/` + offer.executor_id">
                                        {{ offer.executor ? offer.executor.name : executor.name }}
                                    </a>
                                </h4>
                            </div>
                            <div class="column is-3">
                                <div class="buttons">
                                    <b-button
                                        icon-left="check"
                                        :disabled="isActiveButton(offer.select)"
                                        :selected=isActiveButton(offer.select)
                                        :type=isActiveTypeButton(offer.select)>
                                        <small>{{ isActiveButtonText(offer.select) }}</small>
                                    </b-button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div v-if="offer.description">
                            <p>{{ offer.description }}</p>
                            <hr>
                        </div>
                    </div>
                    <div class="columns">
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth m-3">
                            <tbody>
                            <tr>
                                <td><b>{{ lang.repair_amount }}:</b></td>
                                <td>{{ offer.sum_repair }} грн.</td>
                            </tr>
                            <tr>
                                <td><b>{{ lang.parts_amount }}:</b></td>
                                <td>{{ offer.sum_part }} грн.</td>
                            </tr>
                            <tr>
                                <td><b>{{ lang.deadline }}:</b></td>
                                <td>{{ offer.number_hours }} час.</td>
                            </tr>
                            <tr>
                                <td><b>{{ lang.ready_to_execute }}:</b></td>
                                <td>{{ offer.renovation_date }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <b>{{ lang.created_at }}:</b> {{ getCurrentData(offer.created_at) }}
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="offers.length === 0">
                <section class="mb-3">
                    <b-notification v-if="isCloseOffer">
                        {{ lang.can_add_bid }}
                    </b-notification>
                </section>
            </div>

            <b-pagination
                :total="total"
                :current="current"
                :per-page="perPage"
                :current.sync="current"
                @change="getResults(current)">
            </b-pagination>

            <hr>
            <div class="box" v-if="isShowFormOffer">
                <div class="columns">
                    <div class="column">
                        <h4 class="subtitle is-4">{{ lang.add_offer }}</h4>
                    </div>
                    <div class="column">
                        <executor-offer-template
                            :offer_templates="offer_templates"
                            :lang="lang">
                        </executor-offer-template>
                    </div>
                </div>
                <article class="media">
                    <div class="media-content">
                        <div class="columns">
                            <div class="column">
                                <b-field :label="lang.repair_amount">
                                    <b-input
                                        type="text"
                                        pattern="^([0-9]*[.])?[0-9]*$" min="0"
                                        maxlength="10"
                                        placeholder="0"
                                        v-model="sum_repair">
                                    </b-input>
                                    <b-select :placeholder="lang.uah">
                                        <option selected value="UAH">{{ lang.uah }}</option>
                                    </b-select>
                                </b-field>
                                <template v-if="errors">
                                    <small class="is-danger validation_field">
                                        {{ errors.sum_repair ? lang.required + lang.repair_amount : '' }}
                                    </small>
                                </template>
                            </div>
                            <div class="column">
                                <b-field :label="lang.parts_amount">
                                    <b-input
                                        type="text" pattern="^([0-9]*[.])?[0-9]*$"
                                        maxlength="10"
                                        min="0" placeholder="0"
                                        v-model="sum_part">
                                    </b-input>
                                    <b-select :placeholder="lang.uah">
                                        <option selected value="UAH">{{ lang.uah }}</option>
                                    </b-select>
                                </b-field>
                                <template v-if="errors">
                                    <small class="is-danger validation_field">
                                        {{ errors.sum_part ? lang.required + lang.parts_amount : '' }}
                                    </small>
                                </template>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <b-field :label="lang.deadline">
                                    <b-input type="text" pattern="^([0-9]*[.])?[0-9]*$"
                                             maxlength="5"
                                             min="0" placeholder="0" v-model="number_hours">
                                    </b-input>
                                    <b-select :placeholder="lang.hours">
                                        <option selected value="hours">{{ lang.hours }}</option>
                                    </b-select>
                                </b-field>
                                <template v-if="errors">
                                    <small class="is-danger validation_field">
                                        {{ errors.number_hours ? lang.required + lang.deadline : '' }}
                                    </small>
                                </template>
                            </div>
                            <div class="column">
                                <b-field :label="lang.ready_to_execute">
                                    <b-datetimepicker
                                        v-model="renovation_date"
                                        position="is-top-left"
                                        :placeholder="lang.choose_date"
                                        icon="calendar-today"
                                        :min-datetime="new Date()"
                                        :horizontal-time-picker="true"
                                        :timepicker="timepicker"
                                    >
                                    </b-datetimepicker>
                                </b-field>
                                <template v-if="errors">
                                    <small class="is-danger validation_field">
                                        {{ errors.renovation_date ? lang.required + lang.ready_to_execute : '' }}
                                    </small>
                                </template>
                            </div>
                        </div>
                        <div class="field">
                            <b-input maxlength="200" type="textarea"
                                     :placeholder="lang.description"
                                     v-model="description">
                            </b-input>
                            <template v-if="errors">
                                <small class="is-danger validation_field">
                                    {{ errors.description ? lang.required + lang.description : '' }}
                                </small>
                            </template>
                        </div>
                        <div class="field">
                            <p class="control">
                                <button @click="sendOffer"
                                        class="button is-dark">
                                    {{ lang.add }}
                                </button>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
            <div v-else>
                <b-message
                    v-if="isCloseOffer"
                    type="is-success">
                    {{ lang.offer_added }}
                </b-message>
            </div>
        </div>
        <b-loading
            :is-full-page="isFullPage"
            v-model="isLoading"
            :can-cancel="true">
        </b-loading>
    </div>
</template>

<script>
export default {
    name: "ExecutorBidOffersProfile",
    props: ['bid', 'executor', 'lang', 'offer_templates'],
    data() {
        return {
            isShowFormOffer: true,
            isCloseOffer: true,
            isFullPage: true,
            total: 100,
            current: 1,
            perPage: 9,
            offers: [],
            isLoading: false,
            timepicker: {
                incrementMinutes: 1,
                incrementHours: 1
            },
            errors: [],
            description: '',
            sum_repair: null,
            sum_part: null,
            number_hours: null,
            renovation_date: new Date(),
            created_at: '',

        }
    },
    created() {
        this.getResults();
    },
    mounted() {

        this.$root.$on('sendOfferTemplateExecutorBid', data => {
            this.description = data.description
            this.sum_repair = data.sum_repair
            this.sum_part = data.sum_part
            this.number_hours = data.number_hours
        });

        this.bid.offers.filter(x => {
            if (x.executor_id === this.executor.id) {
                this.isShowFormOffer = false
            }
        });

        if (this.bid.status_id !== 1) {
            this.isShowFormOffer = false
            this.isCloseOffer = false
        }
    },
    methods: {
        isActiveButton(val) {
            return val === 1;
        },

        isActiveButtonText(val) {
            if (val === 1) {
                return this.lang.selected
            } else {
                return this.lang.await
            }
        },

        isActiveTypeButton(val) {
            if (val === 1) {
                return 'is-success'
            } else {
                return 'is-light'
            }
        },
        getResults(page = 1) {
            axios.patch('/account/get-list-executor-offers?page=' + page, {
                bid_id: this.bid.id,
                executor_id: this.executor.id
            }).then(r => {
                this.offers = r.data.offers.data;
                this.current = page
                this.total = r.data.all_count
            });
        },

        getCurrentData(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },

        validateFormOffer() {
            return this.description !== '';
        },

        sendOffer() {
            axios.patch('/account/store-executor-bid-offer', {
                description: this.description,
                executor_id: this.executor.id,
                sum_repair: this.sum_repair,
                sum_part: this.sum_part,
                number_hours: this.number_hours,
                renovation_date: this.$luxon(this.renovation_date.toISOString(), "yyyy-MM-dd HH:mm"),
                bid_id: this.bid.id,
                select: 0,
            }).then(r => {
                if (r.data) {
                    this.offers.push({
                        executor_id: this.executor.id,
                        name: this.executor.name,
                        description: this.description,
                        sum_repair: this.sum_repair,
                        sum_part: this.sum_part,
                        number_hours: this.number_hours,
                        renovation_date: this.$luxon(this.renovation_date.toISOString(), "yyyy-MM-dd HH:mm"),
                        created_at: new Date().toISOString(),
                    })
                    this.clearForm()
                    this.isShowFormOffer = false
                } else {
                    this.$buefy.dialog.alert({
                        title: this.lang.limit_offer_on,
                        message: this.lang.limit_offer_info,
                        type: 'is-danger',
                        hasIcon: true,
                        icon: 'information',
                        iconPack: 'mdi',
                        ariaRole: 'alertdialog',
                        ariaModal: true,
                        onConfirm: () => location.href = '/account/executor-packages'
                    })
                }
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        },

        clearForm() {
            this.description = ''
            this.sum_repair = ''
            this.sum_part = ''
            this.number_hours = ''
            this.renovation_date = new Date()
        },
    },
}
</script>

<style scoped>

</style>
