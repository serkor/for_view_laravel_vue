<template>
    <div>
        <section>
            <div v-for="review in reviews" :key="review.id" class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child box">
                        {{ review.description }}
                        <hr>
                        <div class="columns">
                            <div class="column is-6">
                                <b-rate
                                    v-model="review.rate"
                                    :disabled="true">
                                </b-rate>
                            </div>
                            <div class="column is-6">
                                {{ lang.left }}:
                                {{ review.customer.name }}
                                {{ review.customer.surname }}
                                ({{ updateDate(review.created_at) }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section slot="empty">
                <div class="content has-text-grey has-text-centered">
                    <template v-if="isLoading">
                        <p>
                            <b-icon icon="dots-horizontal" size="is-large"/>
                        </p>
                        <p>{{lang.await}}...</p>
                    </template>
                    <template v-if="total === 0">
                        <p>
                            <b-icon icon="emoticon-sad" size="is-large"/>
                        </p>
                        <p>{{ lang.not_reviews }} &hellip;</p>
                    </template>
                </div>
            </section>

            <b-loading :is-full-page="isFullPage"
                       v-model="isLoading"
                       :can-cancel="true">
            </b-loading>

            <b-pagination
                :total="total"
                :current="current"
                :per-page="perPage"
                :current.sync="current"
                @change="getResults(current)">
            </b-pagination>

        </section>
    </div>
</template>

<script>
export default {
    name: "ExecutorListReviewProfile",
    props: ['executor', 'lang'],
    data() {
        return {
            isLoading: false,
            isFullPage: true,
            total: 100,
            current: 1,
            perPage: 9,
            reviews: [],
        }
    },
    mounted() {
        this.$root.$on('sendNewReview', data => {
            if (data) {
                this.getResults();
            }
        });
    },
    created() {
        this.getResults();
    },
    methods: {
        updateDate(val) {
           return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },

        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/executor-get-list-review?page=' + page, {
                executor_id: this.executor.id,
            }).then(r => {
                this.reviews = r.data.reviews.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },
    }
}
</script>

<style scoped>

</style>
