<template>
    <div class="columns">
        <div class="column is-12">
            <section>
                <div v-for="executor in executors" :key="executor.id" class="tile is-ancestor">
                    <div class="tile is-parent">
                        <div class="tile is-child box">

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
                                            <a class="title_link" v-bind:href="'/executor/' + executor.id">
                                                <p class="title">{{ executor.name }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column is-3">
                                            <rate :executor="executor"></rate>
                                        </div>
                                        <div class="column is-6">
                                            <span class="mdi mdi-map"></span> {{ executor.address }}
                                        </div>
                                        <div class="column is-3">
                                            <div class="buttons">
                                                <a :href="'/executor/' + executor.id" class="button is-light">
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

            <section slot="empty">
                <div class="content has-text-grey has-text-centered">
                    <template v-if="isLoading">
                        <p>
                            <b-icon icon="dots-horizontal" size="is-large"/>
                        </p>
                        <p>{{ lang.await }}</p>
                    </template>
                    <template v-if="total === 0">
                        <p>
                            <b-icon icon="emoticon-sad" size="is-large"/>
                        </p>
                        <p>{{lang.not_favorites}} &hellip;</p>
                    </template>
                </div>
            </section>
        </div>
    </div>
</template>

<script>

export default {
    name: "CustomerFavoriteList",
    props: ['lang'],
    data() {
        return {
            isSendModalActive: false,
            isLoading: false,
            isFullPage: true,
            total: 100,
            current: 1,
            perPage: 5,
            executors: [],
        }
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
        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-customer-favorite?page=' + page)
                .then(r => {
                    this.executors = r.data.favorites.data;
                    this.current = page
                    this.total = r.data.all_count
                    this.isLoading = false
                });
        },
    },
}
</script>

<style scoped>

</style>
