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
                            <div class="column">
                                <h4 class="subtitle is-4">
                                    <a :href="`/executor/` + offer.executor.id">
                                        {{ offer.executor.name }}
                                    </a>
                                </h4>
                            </div>
                            <div class="column">
                                <div class="buttons">
                                    <b-button
                                        class="mr-3"
                                        @click="selectOffer(offer.id)"
                                        icon-left="check"
                                        :disabled="isActiveButton(offer.select)"
                                        :selected=isActiveButton(offer.select)
                                        :type=isActiveTypeButton(offer.select)>
                                        <small>{{ isActiveButtonText(offer.select) }}</small>
                                    </b-button>
                                    <span v-if="offer.select">
                                            <b-button
                                                v-if="closeButtonOffers(bid.status_id)"
                                                @click="unSelectOffer(offer.id)"
                                                icon-left="close"
                                                type="is-light">
                                            <small>{{ lang.deny }}</small>
                                            </b-button>
                                        </span>
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
                    <b-notification aria-close-label="Close notification">
                        {{ lang.not_bids }}
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
    name: "CustomerBidOffersProfile",
    props: ['bid', 'lang'],
    data() {
        return {
            isFullPage: true,
            total: 100,
            current: 1,
            perPage: 9,
            offers: [],
            isLoading: false
        }
    },
    created() {
        this.getResults();
    },

    methods: {
        closeButtonOffers(val) {
            return !(val === 3 || val === 4 || val === 5);
        },

        isActiveButton(val) {
            return val === 1;
        },

        isActiveButtonText(val) {
            if (val === 1) {
                return this.lang.selected
            } else {
                return this.lang.select
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
            axios.patch('/account/get-list-customer-offers?page=' + page, {
                bid_id: this.bid.id
            }).then(r => {
                this.offers = r.data.offers.data;
                this.current = page
                this.total = r.data.all_count
            });
        },

        getCurrentData(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },

        selectOffer(val) {
            this.isLoading = true
            axios.patch('/account/select-customer-offer', {
                bid_id: this.bid.id,
                offer_id: val
            }).then(r => {
                this.getResults()
                if (r.data) {
                    this.$buefy.notification.open({
                        message: this.lang.selected_executor,
                        type: 'is-success'
                    })
                    this.$root.$emit('isCanRequiredReview', false);
                } else {
                    this.$buefy.notification.open({
                        message: this.lang.has_selected_executor,
                        type: 'is-danger'
                    })
                }
                this.isLoading = false
            });
        },

        unSelectOffer(val) {
            this.$buefy.dialog.prompt({
                message: this.lang.why_refuse,
                inputAttrs: {
                    value: this.lang.expensive,
                    maxlength: 200,
                    minlength: 20
                },
                trapFocus: true,
                type: 'is-dark',
                confirmText: this.lang.send,
                canCancel: false,
                onConfirm: (value) => {
                    this.isLoading = true
                    this.createComment(value);
                    axios.patch('/account/unselect-customer-offer', {
                        bid_id: this.bid.id,
                        offer_id: val
                    }).then(r => {
                        if (r.data) {
                            this.$buefy.notification.open({
                                message: this.lang.refused_executor,
                                type: 'is-success'
                            })
                            this.$root.$emit('isCanRequiredReview', true);
                        } else {
                            this.$buefy.notification.open({
                                message: this.lang.need_select_executor,
                                type: 'is-danger'
                            })
                        }
                        this.getResults()
                        this.isLoading = false
                    });
                },
            })
        },
        createComment(value) {
            axios.patch('/account/store-customer-comment-bid', {
                id: this.bid.id,
                text: value,
                status_id: this.bid.status_id,
                type: 'customer'
            }).then(r => {
                this.getResults()
            });
        },
    },
}
</script>

<style scoped>

</style>
