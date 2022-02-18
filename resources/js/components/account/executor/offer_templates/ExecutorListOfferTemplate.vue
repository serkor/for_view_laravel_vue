<template>
    <div class="hero-body">
        <div class="row box_account">
            <div class="col-md-12 cart_service table__wrapper">
                <table class="table is-striped">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Найменование</th>
                        <th>Запчасти (Сумма)</th>
                        <th>Ремонт (Сумма)</th>
                        <th>Срок выполнения</th>
                        <th>Описание</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(template, index) in offer_templates" :key="template.id">
                        <td>{{ template ? template.id : index + 1 }}</td>
                        <td>{{ template.name }}</td>
                        <td>{{ template.sum_part }}</td>
                        <td>{{ template.sum_repair }}</td>
                        <td>{{ template.number_hours }}</td>
                        <td>{{ template.description }}</td>
                        <td>
                            <div class="buttons">
                                <b-button @click="deleteTemplate(template.id, index)" type="is-danger is-light">
                                    <span class="mdi mdi-delete"></span>
                                </b-button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <b-loading :is-full-page="isFullPage"
                           v-model="isLoading"
                           :can-cancel="true">
                </b-loading>

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
                            <p>{{ lang.not_offer_templates }} &hellip;</p>
                        </template>
                    </div>
                </section>
            </div>
        </div>
        <b-pagination
            :total="total"
            :current="current"
            :per-page="perPage"
            :current.sync="current"
            @change="getResults(current)">
        </b-pagination>
    </div>
</template>

<script>
export default {
    name: "ExecutorListOfferTemplate",
    props: ['executor', 'lang'],
    data() {
        return {
            isFullPage: true,
            isLoading: true,
            total: 100,
            current: 1,
            perPage: 9,
            offer_templates: [],
        }
    },
    created() {
        this.getResults();
    },

    mounted() {
        this.$root.$on('addNewOfferTemplate', data => {
            if (data) {
                this.getResults();
            }
        });
    },

    methods: {
        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-executor-offer-templates?page=' + page, {
                executor_id: this.executor.id,
            }).then(r => {
                this.offer_templates = r.data.offer_templates.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },

        deleteTemplate(id, index){
            axios.patch('/account/delete-customer-offer-template', {
                id: id,
            }).then(r => {
                this.offer_templates.splice(index, 1);
                this.$buefy.notification.open({
                    message: this.lang.deleted,
                    type: 'is-success'
                })
            }).catch(error => {
                this.errors = error.response.data.errors
            })

        },

    }
}
</script>

<style scoped>

</style>
