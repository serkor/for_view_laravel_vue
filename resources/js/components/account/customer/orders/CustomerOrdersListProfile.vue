<template>

    <div class="columns">
        <div class="column is-12">
            <div class="hero-body">
                <div class="box_account box">
                    <div class="columns box m-2">
                        <div class="column is-6">
                            <table class="table is-narrow">
                                <thead>
                                <tr>
                                    <th>{{ lang.period }}</th>
                                    <th>{{ lang.repair_amount }}</th>
                                    <th>{{ lang.parts_amount }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ lang.year_sum }}</td>
                                    <td>{{ year_sum_repair }} грн.</td>
                                    <td>{{ year_sum_part }} грн.</td>
                                </tr>
                                <tr>
                                    <td>{{ lang.month_sum }}</td>
                                    <td>{{ month_sum_repair }} грн.</td>
                                    <td>{{ month_sum_part }} грн.</td>
                                </tr>
                                <tr>
                                    <td>{{ lang.week_sum }}</td>
                                    <td>{{ week_sum_repair }} грн.</td>
                                    <td>{{ week_sum_part }} грн.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="column is-3">
                            <b-field grouped group-multiline :label="lang.choose_period">
                                <b-datepicker
                                    :placeholder="lang.start_date"
                                    icon="calendar-today"
                                    v-model="filters.start_date">
                                </b-datepicker>
                                <b-datepicker
                                    :placeholder="lang.end_date"
                                    icon="calendar-today"
                                    v-model="filters.end_date">
                                </b-datepicker>
                            </b-field>
                        </div>
                        <div class="column is-3">
                            <b-field label="Статус">
                                <b-select v-model="filters.status_id" horizontal>
                                    <option selected value="null">{{ lang.all }}</option>
                                    <option value="3">{{ lang.completed }}</option>
                                    <option value="5">{{ lang.closed }}</option>
                                    <option value="4">{{ lang.canceled }}</option>
                                </b-select>
                            </b-field>
                            <div class="buttons">
                                <b-button type="is-dark" @click="getResults()">{{ lang.to_apply }}</b-button>
                                <b-button type="is-dark is-outlined" @click="clearForm">{{ lang.discharge }}</b-button>
                            </div>
                        </div>
                    </div>

                    <template>
                        <b-field grouped group-multiline class="mt-5">
                            <div class="control">
                                <b-switch type="is-success" v-model="dateSearch">{{ lang.search }}</b-switch>
                            </div>
                        </b-field>
                        <b-table :data="orders" scrollable>
                            <b-table-column field="id" label="№"
                                            sortable v-slot="props"
                                            :searchable="dateSearch">
                                {{ props.row.id }}
                            </b-table-column>
                            <b-table-column field="executor"
                                            :label="lang.executor"
                                            sortable v-slot="props"
                                            :searchable="dateSearch"
                                            :custom-search="searchExName">
                                {{ props.row.executor ? props.row.executor.name : lang.not_selected }}
                            </b-table-column>
                            <b-table-column field="vin" label="VIN"
                                            sortable v-slot="props"
                                            :searchable="dateSearch"
                                            :custom-search="searchVIN">
                                {{ props.row.car.vin }}
                            </b-table-column>
                            <b-table-column field="sum_repair"
                                            :label="lang.repair_amount"
                                            sortable v-slot="props"
                                            :searchable="dateSearch">
                                {{ props.row.sum_repair }}
                            </b-table-column>
                            <b-table-column field="sum_part"
                                            :label="lang.parts_amount"
                                            sortable v-slot="props"
                                            :searchable="dateSearch">
                                {{ props.row.sum_part }}
                            </b-table-column>
                            <b-table-column field="status_id"
                                            :label="lang.status"
                                            sortable v-slot="props">
                                {{ props.row.status.name }}
                            </b-table-column>
                            <b-table-column field="updated_at"
                                            :label="lang.updated"
                                            sortable v-slot="props">
                                {{ getDataFormat(props.row.updated_at) }}
                            </b-table-column>

                            <b-table-column field="action" v-slot="props">
                                <div class="buttons">
                                    <a class="is-dark is-light"
                                       :href="'customer-bid/' + props.row.id">
                                        <span class="ml-2 mdi mdi-arrow-right-box mdi-24px"></span>
                                    </a>
                                </div>
                            </b-table-column>

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

                            <template #footer>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{ sum_repair }} грн.</th>
                                <th>{{ sum_part }} грн.</th>
                                <th></th>
                                <th></th>
                            </template>
                        </b-table>

                        <b-loading
                            :is-full-page="isFullPage"
                            v-model="isLoading"
                            :can-cancel="true">
                        </b-loading>
                    </template>
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
    name: "CustomerOrdersListProfile",
    props: ['customer', 'lang'],
    data() {
        return {
            isFullPage: false,
            isLoading: true,
            total: 100,
            current: 1,
            perPage: 9,
            orders: [],
            filters: {
                status_id: null,
                start_date: new Date(),
                end_date: new Date(),
            },
            sum_repair: 0,
            sum_part: 0,
            year_sum_repair: 0,
            year_sum_part: 0,
            month_sum_repair: 0,
            month_sum_part: 0,
            week_sum_repair: 0,
            week_sum_part: 0,
            dateSearch: false,
        }
    },
    created() {
        this.getResults();
    },

    methods: {
        searchVIN(row, input) {
            return input && row.car.vin && row.car.vin.includes(input);
        },
        searchExName(row, input) {
            return input && row.executor.name && row.executor.name.includes(input);
        },
        dateFormat(val) {
            return this.$luxon(val.toISOString(), 'yyyy-MM-dd')
        },
        getDataFormat(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },
        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-customer-orders?page=' + page, {
                customer_id: this.customer.id,
                status_id: this.filters.status_id,
                start_date: this.filters.start_date ? this.$luxon(this.filters.start_date.toISOString(), "yyyy-MM-dd") : null,
                end_date: this.filters.end_date ? this.$luxon(this.filters.end_date.toISOString(), "yyyy-MM-dd") : null,
            }).then(r => {
                this.orders = r.data.orders.data;
                this.sum_repair = r.data.sum_repair;
                this.sum_part = r.data.sum_part;

                this.year_sum_repair = r.data.year_sum_repair;
                this.year_sum_part = r.data.year_sum_part;
                this.month_sum_repair = r.data.month_sum_repair;
                this.month_sum_part = r.data.month_sum_part;
                this.week_sum_repair = r.data.week_sum_repair;
                this.week_sum_part = r.data.week_sum_part;

                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },
        clearForm() {
            this.filters.status_id = null
            this.filters.start_date = new Date()
            this.filters.end_date = new Date()
            this.getResults();
        }
    },

}
</script>

<style scoped>

</style>
