<template>
    <div>
        <section class="section box">
            <div class="columns">
                <div class="column">
                    <div class="box">
                        <h4 class="subtitle is-4">
                            <span class="mdi mdi-information-variant"></span>
                            {{ lang.description }}
                        </h4>
                        <div class="columns">
                            <div class="column is-12">
                                <b-taglist>
                                    <b-tag type="is-text is-medium"
                                           v-for="category in bid.categories" :key="category.id">
                                        {{ category.name }}
                                    </b-tag>
                                </b-taglist>
                                <hr>
                                <section>
                                    <div v-if="isShowDesc">
                                        <p>{{ bid.description }}</p>
                                        <span v-if="files">
                                         <br><a title="Скачать файл" v-for="file in files"
                                                class="file_bid"
                                                :href="'/storage/files/' + file.url">
                                            <span class="mdi mdi-file-document"></span>
                                         </a><hr>
                                    </span>
                                        <br>
                                        <div class="mb-3">
                                            <div class="columns table__wrapper">
                                                <div class="column">
                                                    <table class="table is-fullwidth is-hoverable">
                                                        <tbody>
                                                        <tr>
                                                            <td><b>{{ lang.mark }}:</b></td>
                                                            <td>{{ bid.car.mark.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>{{ lang.mark_model }}:</b></td>
                                                            <td>{{ bid.car.mark_model.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>{{ lang.transmission }}:</b></td>
                                                            <td>{{ bid.car.transmission.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>{{ lang.year }}:</b></td>
                                                            <td>{{ bid.car.year.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>VIN:</b></td>
                                                            <td>{{ bid.car.vin }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>{{ lang.city }}:</b></td>
                                                            <td>{{ bid.city.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>{{ lang.desired_date }}:</b></td>
                                                            <td>{{ bid.desired_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>{{ lang.type }}:</b></td>
                                                            <td>
                                                                <b-tag :type="class_type">
                                                                    {{ getType(bid.type) }}
                                                                </b-tag>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column is-8">
                                            <div class="buttons">
                                                <b-button @click="showDescription" type="is-info is-light" hovered>
                                                    {{ lang.more }}
                                                    <span class="mdi mdi-unfold-more-horizontal"></span>
                                                </b-button>
                                            </div>
                                        </div>
                                        <div class="column is-4">
                                            <div class="buttons" v-if="closeButtonStatus(bid.status_id)">
                                                <b-tooltip position="is-bottom" type="is-info" multilined>
                                                    <b-button :title="lang.close"
                                                        @click="updateBidStatus(bid.id, 5)"
                                                        class="mr-2">
                                                        <span class="mdi mdi-close"></span>
                                                    </b-button>
                                                    <template v-slot:content>
                                                        {{ lang.close_info_status }}
                                                    </template>
                                                </b-tooltip>
                                                <b-tooltip position="is-bottom" type="is-info" multilined>
                                                    <b-button :title="lang.update"
                                                        @click="updateBidStatus(bid.id, 1)"
                                                        class="ml-2">
                                                        <span class="mdi mdi-sync"></span>
                                                    </b-button>
                                                    <template v-slot:content>
                                                        {{ lang.update_info_status }}
                                                    </template>
                                                </b-tooltip>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <customer-bid-comments-profile
                            :bid="bid"
                            :lang="lang"
                            :all_statuses="all_statuses"
                            :comments="comments"/>
                    </div>
                    <div class="box">
                        <customer-bid-questions-profile :lang="lang" :bid="bid"/>
                    </div>
                </div>
                <div class="column">
                    <customer-bid-offers-profile :lang="lang" :bid="bid"/>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
export default {
    name: "CustomerBidProfile",
    props: ['bid', 'lang', 'all_statuses', 'files'],
    data() {
        return {
            isShowDesc: false,
            class_type: 'is-info is-light',
            comments: this.bid.comments,
            requiredReview: true,
            id: null,
            status_id: null,
        }
    },

    created() {
        if (this.bid.executor_id !== null) {
            this.requiredReview = false
        }
    },

    mounted() {
        this.$root.$on('isCanRequiredReview', data => {
            this.requiredReview = data
        });
    },

    methods: {
        updateBidStatus(id, status_id) {
            this.id = id
            this.status_id = status_id
            if (this.requiredReview) {
                if (this.status_id === 1) {
                    this.update();
                    location.href = "/account/customer-bids";
                } else {
                    this.update();
                    location.href = "/account/customer-orders";
                }
            } else {
                this.redirectReview();
            }
        },

        update() {
            axios.patch('/account/update-customer-bid-status', {
                id: this.id,
                status_id: this.status_id,
                text: this.lang.status_change_success,
                type: 'status',
            }).then(r => {
                this.comments = r.data.bid.comments
                this.$root.$emit('isChangeStatusCustomerBid', true)
                this.$buefy.notification.open({
                    message: this.lang.status_change,
                    type: 'is-success'
                })
            });
        },

        redirectReview() {
            if (this.status_id === 1) {
                this.update();
                location.href = "/account/customer-bids";
            } else {
                this.$buefy.dialog.confirm({
                    type: 'is-dark',
                    confirmText: this.lang.estimate,
                    cancelText: this.lang.not_want,
                    message: this.lang.estimate_executor,
                    onConfirm: () => {
                        this.update();
                        location.href = "/executor/" + this.bid.executor_id;
                    },
                    onCancel: () => {
                        this.update();
                        location.href = "/account/customer-orders";
                    }
                })
            }
        },

        closeButtonStatus(val) {
            return !(val === 3 || val === 4 || val === 5 || val === 6);
        },

        getType(val) {
            if (val === 1) {
                this.class_type = 'is-danger'
                return this.lang.quickly
            } else {
                return this.lang.default
            }
        },

        showDescription() {
            this.isShowDesc = !this.isShowDesc;
        },
    },
}
</script>

<style scoped>

</style>
