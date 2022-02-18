<template>

    <div class="columns">
        <div class="column is-3">
            <div class="hero-body">
                <div class="box_account box">

                    <section>
                        <site-city-catalog :cities="cities" :executor="executor" class="mb-3"></site-city-catalog>
                        <site-category-catalog :categories="categories" class="mb-3"></site-category-catalog>
                        <b-field :label="lang.filter.desired_date">
                            <b-datepicker
                                :placeholder="this.$luxon(new Date().toISOString(), 'yyyy-MM-dd')"
                                icon="calendar-today"
                                v-model="filters.desired_date">
                            </b-datepicker>
                        </b-field>
                        <b-field label="Тип заказа">
                            <b-switch v-model="filters.type"
                                      type="is-danger">
                                {{ lang.filter.quickly }}
                            </b-switch>
                        </b-field>
                        <hr>
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-dark" @click="getResults()">
                                    {{ lang.filter.search }}
                                </button>
                            </div>
                            <div class="control">
                                <button class="button is-dark is-light" @click="clearData()">
                                    {{ lang.filter.refresh }}
                                </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="column is-9">
            <div class="hero-body">
                <div class="box_account box">

                    <b-field grouped group-multiline>
                        <div class="control">
                            <b-switch type="is-success" v-model="dateSearchable">
                                Искать №
                            </b-switch>
                        </div>
                    </b-field>

                    <template>
                        <b-tabs v-model="activeTab" type="is-toggle" size="is-medium" expanded>

                            <b-tab-item value="open">
                                <template #header>
                                    <b-icon icon="package-up"></b-icon>
                                    <span class="mr-3">{{ lang.open }}</span>
                                    <b-tag rounded> {{ open_count }}</b-tag>
                                </template>
                                <executor-bid-table
                                    :lang="lang"
                                    :bids="bids"
                                    :executor="executor"
                                    :dateSearchable="dateSearchable"/>
                            </b-tab-item>

                            <b-tab-item value="expected">
                                <template #header>
                                    <b-icon icon="pause"></b-icon>
                                    <span class="mr-3">{{ lang.expected }}</span>
                                    <b-tag rounded> {{ expected_count }}</b-tag>
                                </template>
                                <executor-bid-table
                                    :lang="lang" :bids="bids"
                                    :executor="executor"
                                    :dateSearchable="dateSearchable"/>
                            </b-tab-item>

                            <b-tab-item value="selected">
                                <template #header>
                                    <b-icon icon="check-all"></b-icon>
                                    <span class="mr-3">{{ lang.selected }}</span>
                                    <b-tag rounded> {{ selected_count }}</b-tag>
                                </template>
                                <executor-bid-table
                                    :lang="lang" :bids="bids"
                                    :executor="executor"
                                    :dateSearchable="dateSearchable"/>
                            </b-tab-item>

                            <b-loading
                                :is-full-page="isFullPage"
                                v-model="isLoading"
                                :can-cancel="true">
                            </b-loading>

                        </b-tabs>
                    </template>

                    <section slot="empty">
                        <div class="content has-text-grey has-text-centered">
                            <template v-if="isLoading"></template>
                            <template v-if="total === 0">
                                <p>
                                    <b-icon icon="emoticon-sad" size="is-large"/>
                                </p>
                                <p>{{ lang.nothing }} &hellip;</p>
                            </template>
                        </div>
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
        </div>
    </div>
</template>

<script>

export default {
    name: "ExecutorBidsListProfile",
    props: ['executor', 'lang','cities', 'categories'],
    data() {
        return {
            isFullPage: false,
            isLoading: true,
            total: 100,
            current: 1,
            perPage: 9,
            bids: [],
            activeTab: 'open',
            statuses: [],
            class_type: '',
            filters: {
                city_id: null,
                category_id: null,
                desired_date: null,
                type: null,
            },
            open_count: 0,
            expected_count: 0,
            selected_count: 0,
            dateSearchable: false,
        }
    },
    created() {
        this.getResults();
        this.getCount();
    },

    mounted() {
        this.activeTab = localStorage.getItem('ExecutorActiveTab')

        this.$root.$on('getCatalogCityId', data => {
            this.filters.city_id = data
        });

        this.$root.$on('getCatalogCategoryId', data => {
            this.filters.category_id = data
        });

        this.$root.$on('isChangeStatusExecutorBid', data => {
            if (data) {
                this.getResults();
                this.getCount()
            }
        });

        setInterval(() => {
            this.getCount()
        }, 300000)
    },

    methods: {

        getCount() {
            axios.patch('/account/get-list-executor-bids-count', {
                executor_id: this.executor.id,
            }).then(r => {
                this.open_count = r.data.open_count;
                this.expected_count = r.data.expected_count;
                this.selected_count = r.data.selected_count;
            });
        },

        updateBidStatus(bid_id, status_id) {
            axios.patch('/account/update-executor-bid', {
                id: bid_id,
                status_id: status_id,
            }).then(r => {
                this.getResults();
                this.getCount()
            });
        },

        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-executor-bids?page=' + page, {
                executor_id: this.executor.id,
                tab: this.activeTab,
                city_id: this.filters.city_id,
                category_id: this.filters.category_id,
                desired_date: this.$luxon(this.filters.desired_date ? this.filters.desired_date.toISOString() : '', "yyyy-MM-dd"),
                type: this.filters.type,
            }).then(r => {
                this.bids = r.data.bids.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },

        clearData() {
            this.filters.category_id = null
            this.filters.city_id = null
            this.filters.desired_date = null
            this.filters.type = null
            this.getResults()
            this.getCount()
        },

    },

    watch: {
        activeTab(val) {
            this.getResults();
            localStorage.setItem('ExecutorActiveTab', val);
        },
    }
}
</script>

<style scoped>

</style>
