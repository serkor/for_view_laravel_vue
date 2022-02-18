<template>
    <div class="columns">

        <div class="column is-12">
            <div class="row box_account box">

                <b-field grouped group-multiline>
                    <div class="control">
                        <b-switch type="is-success" v-model="dateSearchable">Искать №</b-switch>
                    </div>
                </b-field>

                <template>
                    <b-tabs v-model="activeTab" type="is-toggle" size="is-medium" expanded>
                        <b-tab-item value="open">
                            <template #header>
                                <b-icon icon="package-up"></b-icon>
                                <span class="mr-3">{{lang.open}}</span>
                                <b-tag rounded> {{open_count}} </b-tag>
                            </template>

                            <customer-bid-table
                                :bids="bids"
                                :customer="customer"
                                :lang="lang"
                                :dateSearchable="dateSearchable"/>
                        </b-tab-item>
                        <b-tab-item value="confirmed">
                            <template #header>
                                <b-icon icon="check-all"></b-icon>
                                <span class="mr-3">{{lang.confirmed}}</span>
                                <b-tag rounded> {{confirmed_count}} </b-tag>
                            </template>

                            <customer-bid-table
                                :bids="bids"
                                :customer="customer"
                                :lang="lang"
                                :dateSearchable="dateSearchable"/>
                        </b-tab-item>
                        <b-tab-item value="canceled">
                            <template #header>
                                <b-icon icon="backup-restore"></b-icon>
                                <span class="mr-3">{{lang.canceled}}</span>
                                <b-tag rounded> {{canceled_count}} </b-tag>
                            </template>

                            <customer-bid-table
                                :bids="bids"
                                :customer="customer"
                                :lang="lang"
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
</template>

<script>
export default {
    name: "CustomerBidsListProfile",
    props: ['customer', 'cities', 'categories', 'cars', 'lang', 'statuses'],
    data() {
        return {
            isFullPage: false,
            isLoading: true,
            total: 100,
            current: 1,
            perPage: 9,
            bids: [],
            activeTab: 'open',
            open_count: 0,
            confirmed_count: 0,
            canceled_count: 0,
            dateSearchable: false,
        }
    },
    created() {
        this.getResults();
        this.getCount()
    },

    mounted() {
        this.activeTab = localStorage.getItem('CustomerActiveTab')

        this.$root.$on('isAddNewBid', data => {
            if (data) {
                this.getResults();
                this.getCount()
            }
        });

        this.$root.$on('isChangeStatusCustomerBid', data => {
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
            axios.patch('/account/get-list-customer-bids-count', {
                customer_id: this.customer.id,
            }).then(r => {
                this.open_count = r.data.open_count;
                this.confirmed_count = r.data.confirmed_count;
                this.canceled_count = r.data.canceled_count;
            });
        },

        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-customer-bids?page=' + page, {
                customer_id: this.customer.id,
                tab: this.activeTab,
            }).then(r => {
                this.bids = r.data.bids.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },
    },

    watch: {
        activeTab(val) {
            this.getResults();
            localStorage.setItem('CustomerActiveTab', val);
        }
    }
}
</script>

<style scoped>

</style>
