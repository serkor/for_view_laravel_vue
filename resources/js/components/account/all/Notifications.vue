<template>
    <div class="hero-body">
        <div class="row box_account box">
            <div class="col-md-12 cart_service table__wrapper">
                <table class="table is-striped">
                    <thead>
                    <tr>
                        <th>{{ lang.name }}</th>
                        <th>{{ lang.text }}</th>
                        <th>{{ lang.created_at }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(notify, index) in notifications" :key="notify.id">
                        <td>{{ notify.data.name }}</td>
                        <td>{{ notify.data.text }}</td>
                        <td>{{ getDataFormat(notify.created_at) }}</td>
                        <td>
                            <a class="button" title="Перейти к записи" :href="notify.data.url">
                                <span class="mdi mdi-arrow-right-box mdi-24px"></span>
                            </a>
                        </td>
                        <td>
                            <div class="buttons">
                                <b-button @click="read(notify.id, index)">
                                    <span class="mdi mdi-delete"></span>
                                </b-button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <b-loading
                    :is-full-page="isFullPage"
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
                            <p>{{ lang.nothing }} &hellip;</p>
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
    name: "Notifications",
    props: ['lang'],
    data() {
        return {
            isFullPage: true,
            isLoading: true,
            total: 100,
            current: 1,
            perPage: 9,
            notifications: [],
            active: '',
        }
    },
    created() {
        this.getResults();
    },

    methods: {
        getDataFormat(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },

        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-notifications?page=' + page).then(r => {
                this.notifications = r.data.notifications.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },

        read(id, index) {
            axios.patch('/account/notification-read', {
                id: id,
            }).then(r => {
                this.notifications.splice(index, 1);
                this.$buefy.notification.open({
                    message: this.lang.seen_info,
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
