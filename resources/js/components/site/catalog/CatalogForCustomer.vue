<template>
    <div class="columns">
        <div class="column is-3">
            <div class="hero-body">
                <div class="row box_account box">
                    <section>
                        <b-field :label="lang.catalog.filter.name">
                            <b-input icon="magnify" v-model="filters.name" placeholder="Автомикс.."></b-input>
                        </b-field>
                        <site-city-catalog :cities="cities" class="mb-3"></site-city-catalog>
                        <site-category-catalog :categories="categories" class="mb-3"></site-category-catalog>
                        <hr>
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-dark" @click="getResults()">
                                    {{ lang.catalog.filter.search }}
                                </button>
                            </div>
                            <div class="control">
                                <button class="button is-dark is-light" @click="clearData()">
                                    {{ lang.catalog.filter.refresh }}
                                </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="column is-9">
            <div class="hero-body">
                <div class="row box_account box">

                    <div class="columns">
                        <div class="column is-6"></div>
                        <div class="column is-3"></div>
                        <div class="column is-3">
                            <b-field>
                                <b-select v-model="sort" @input="getSortResult"
                                          :placeholder="lang.catalog.sort" icon="sort">
                                    <option value="created_at">{{ lang.catalog.sort_default }}</option>
                                    <option value="rate">{{ lang.catalog.sort_rate }}</option>
                                </b-select>
                            </b-field>
                        </div>
                    </div>

                    <section>
                        <div v-for="executor in executors" :key="executor.id" class="tile is-ancestor">
                            <div class="tile is-parent">
                                <div class="tile is-child box"
                                     :class="{ package: getPremium(executor.package_id) }">

                                    <div class="columns">
                                        <div class="column is-2">
                                            <div v-if="getPremium(executor.package_id) && executor.image">
                                                <a v-bind:href="'executor/' + executor.id">
                                                    <img class="logo_catalog_executor"
                                                         :src="'/storage/avatar/' + executor.image">
                                                </a>
                                            </div>
                                            <div v-else>
                                                <img class="logo_catalog_executor"
                                                     :src="'/public/images/executor_no.png'">
                                            </div>
                                        </div>
                                        <div class="column is-10">
                                            <div class="columns executor_title_link">
                                                <div class="column">
                                                    <a class="title_link" v-bind:href="'executor/' + executor.id">
                                                        <p class="title">{{ executor.name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="columns">
                                                <div class="column is-3">
                                                    <rate :executor="executor"></rate>
                                                </div>
                                                <div class="column is-1">
                                                    <span class="mdi mdi-comment-multiple-outline"></span>
                                                    {{ executor.reviews.length }}
                                                </div>
                                                <div class="column is-5">
                                                    <span class="mdi mdi-map"></span> {{ executor.address }}
                                                </div>
                                                <div class="column is-3">
                                                    <div class="buttons">
                                                        <b-tooltip position="is-top" multilined>
                                                            <button
                                                                v-if="getPremium(executor.package_id)"
                                                                class="button is-dark"
                                                                @click="sendModalActive(executor.id)">
                                                                <span class="mdi mdi-gavel mdi-24px"></span>
                                                            </button>
                                                            <template v-slot:content>
                                                                {{lang.catalog.add_bid}}
                                                            </template>
                                                        </b-tooltip>
                                                        <a :href="'executor/' + executor.id" class="button is-light">
                                                            <span class="mdi mdi-transfer-right"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <b-loading
                            :is-full-page="isFullPage"
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

                    <section slot="empty">
                        <div class="content has-text-grey has-text-centered">
                            <template v-if="isLoading">
                                <p>
                                    <b-icon icon="dots-horizontal" size="is-large"/>
                                </p>
                                <p>Ожидайте, получение данных...</p>
                            </template>
                            <template v-if="total === 0">
                                <p>
                                    <b-icon icon="emoticon-sad" size="is-large"/>
                                </p>
                                <p>Ничего не найдено &hellip;</p>
                            </template>
                        </div>
                    </section>

                    <b-modal
                        v-model="isSendModalActive"
                        trap-focus
                        :destroy-on-hide="false"
                        aria-role="dialog"
                        full-screen
                        scroll="keep"
                        aria-modal>
                        <customer-create-bid-catalog
                            :lang="lang_bid"
                            :cars="cars"
                            :cities="cities"
                            :categories="categories"
                            :years="years"
                            :marks="marks"
                            :mark_models="mark_models"
                            :customer="customer"
                            :transmissions="transmissions"
                            :isSendModalActive="isSendModalActive"
                            :executor_id="executor_id">
                        </customer-create-bid-catalog>
                    </b-modal>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Catalog",
    props: ['customer', 'cars', 'lang', 'lang_bid', 'years', 'marks', 'mark_models', 'transmissions', 'cities', 'categories'],
    data() {
        return {
            executor_id: null,
            isSendModalActive: false,
            isLoading: false,
            isFullPage: true,
            total: 100,
            current: 1,
            perPage: 9,
            executors: [],
            sort: 'created_at',
            filters: {
                name: '',
                city_id: null,
                category_id: null,
                rate: null,
            },
        }
    },

    mounted() {
        this.$root.$on('isSendModalActive', data => {
            this.isSendModalActive = data
        });

        this.$root.$on('getCatalogCityId', data => {
            this.filters.city_id = data
        });

        this.$root.$on('getCatalogCategoryId', data => {
            this.filters.category_id = data
        });
    },

    created() {
        this.getResults();
    },

    methods: {
        getPremium(val) {
            if (val === 2) {
                return true
            }
        },

        sendModalActive(id) {
            this.isSendModalActive = true
            this.executor_id = id
        },

        getSortResult() {
            this.getResults();
        },

        getResults(page = 1) {
            this.isLoading = true
            axios.patch('get-site-catalog-executors?page=' + page, {
                data: {
                    filters: {
                        name: this.filters.name,
                        city_id: this.filters.city_id,
                        category_id: this.filters.category_id,
                        rate: this.filters.rate,
                    },
                    sorts: {
                        sort: this.sort
                    }
                }
            }).then(r => {
                this.executors = r.data.executors.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },

        clearData() {
            this.filters.name = ''
            this.filters.category_id = null
            this.filters.city_id = null
            this.filters.rate = null
            this.$root.$emit('isClearFilterCatalog', true);
            this.getResults()
        },
    },
}
</script>

<style scoped>

</style>
