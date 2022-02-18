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

                                <article class="message is-dark"
                                         v-if="executor.id === bid.executor_id">
                                    <div class="message-body">
                                        <strong>{{ lang.customer }}: </strong>
                                        {{ bid.customer.name }}
                                        {{ bid.customer.surname }},
                                        <span class="mdi mdi-phone"></span>
                                        {{ bid.customer.phone }}
                                    </div>
                                </article>

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
                                            <b-button @click="showDescription" type="is-info is-light" hovered>
                                                {{ lang.more }}
                                                <span class="mdi mdi-unfold-more-horizontal"></span>
                                            </b-button>
                                        </div>
                                        <div class="column is-4" v-if="executor.id === bid.executor_id">
                                            <div class="buttons" v-if="closeButtonStatus(bid.status_id)">
                                                <b-tooltip position="is-bottom" type="is-info is-light" multilined>
                                                    <b-button
                                                        :title="lang.complete"
                                                        @click="updateBidStatus(bid.id, 3)"
                                                        class="mr-2">
                                                        <span class="mdi mdi-checkbox-marked-circle-outline"></span>
                                                    </b-button>
                                                    <template v-slot:content>
                                                        {{ lang.complete_info_status }}
                                                    </template>
                                                </b-tooltip>
                                                <b-tooltip position="is-bottom" type="is-info is-light" multilined>
                                                    <b-button
                                                        :title="lang.dont_complete"
                                                        @click="updateBidStatus(bid.id, 4)"
                                                        class="ml-2">
                                                        <span class="mdi mdi-close-circle-outline"></span>
                                                    </b-button>
                                                    <template v-slot:content>
                                                        {{ lang.dont_complete_info_status }}
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
                        <executor-bid-comments-profile
                            :bid="bid"
                            :lang="lang"
                            :all_statuses="all_statuses"
                            :comments="comments"/>
                    </div>
                    <div class="box">
                        <executor-bid-questions-profile :lang="lang" :bid="bid" :executor="executor"/>
                    </div>
                </div>
                <div class="column">
                    <executor-bid-offers-profile :offer_templates="offer_templates" :lang="lang" :bid="bid" :executor="executor"/>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
export default {
    name: "ExecutorBidProfile",
    props: ['bid', 'executor', 'lang', 'all_statuses', 'files', 'offer_templates'],
    data() {
        return {
            isShowDesc: true,
            class_type: 'is-info is-light',
            comments: this.bid.comments,
            id: null,
            status_id: null,
        }
    },

    methods: {
        updateBidStatus(id, status_id) {
            this.id = id
            this.status_id = status_id
            if (this.status_id === 4) {
                this.$buefy.dialog.prompt({
                    type: 'is-dark',
                    message: this.lang.why_dont_ready,
                    confirmText: this.lang.saved,
                    cancelText: this.lang.close,
                    inputAttrs: {
                        // placeholder: 'Заказчик не приехал....',
                        placeholder: this.lang.dont_come,
                        value: '',
                        min: 20,
                        max: 100
                    },
                    trapFocus: true,
                    onConfirm: (value) => {
                        this.createComment(value);
                        this.update();
                    },
                })
            } else {
                this.update();
            }
        },

        update() {
            axios.patch('/account/update-executor-bid-status', {
                id: this.id,
                status_id: this.status_id,
                text: this.lang.status_change_success,
                type: 'status',
            }).then(r => {
                this.comments = r.data.bid.comments
                this.$root.$emit('isChangeStatusExecutorBid', true)
                this.$buefy.notification.open({
                    message: this.lang.status_change,
                    type: 'is-success'
                })
                location.href = "/account/executor-orders";
            });
        },

        createComment(value) {
            axios.patch('/account/store-executor-comment-bid', {
                id: this.bid.id,
                text: value,
                status_id: this.bid.status_id,
                type: 'executor'
            });
        },

        getType(val) {
            if (val === 1) {
                this.class_type = 'is-danger'
                return this.lang.quickly
            } else {
                return this.lang.default
            }
        },

        closeButtonStatus(val) {
            return !(val === 3 || val === 4 || val === 5);
        },

        getStatusName(val) {
            const status = this.all_statuses.find(status => status.id === val);
            return status ? status.name : ''
        },

        showDescription() {
            this.isShowDesc = !this.isShowDesc;
        },
    },
}
</script>

<style scoped>

</style>
