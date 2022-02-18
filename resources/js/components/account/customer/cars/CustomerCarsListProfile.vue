<template>
    <div class="hero-body">
        <div class="row box_account">
            <div class="col-md-12 cart_service table__wrapper">
                <table class="table is-striped">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>VIN</th>
                        <th>{{ lang.mark }}</th>
                        <th>{{ lang.mark_model }}</th>
                        <th>{{ lang.transmission }}</th>
                        <th>{{ lang.year }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(car, index) in cars" :key="cars.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ car.vin }}</td>
                        <td>{{ getMarkName(car.mark_id) }}</td>
                        <td>{{ getMarkModelName(car.mark_model_id) }}</td>
                        <td>{{ getTransmissionsName(car.transmission_id) }}</td>
                        <td>{{ getYearsName(car.year_id) }}</td>
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
                            <p>{{ lang.not_cars }} &hellip;</p>
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
    name: "CustomerCarsProfile",
    props: ['customer', 'marks', 'mark_models', 'transmissions', 'years', 'lang'],
    data() {
        return {
            isFullPage: true,
            isLoading: true,
            total: 100,
            current: 1,
            perPage: 9,
            cars: [],
        }
    },
    created() {
        this.getResults();
    },

    mounted() {
        this.$root.$on('isAddNewCar', data => {
            if (data) {
                this.getResults();
            }
        });
    },

    methods: {
        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-customer-cars?page=' + page, {
                customer_id: this.customer.id,
            }).then(r => {
                this.cars = r.data.cars.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },

        getMarkName(val) {
            const name = this.marks.find(name => name.id === val);
            return name ? name.name : ''
        },
        getMarkModelName(val) {
            const name = this.mark_models.find(name => name.id === val);
            return name ? name.name : ''
        },
        getTransmissionsName(val) {
            const name = this.transmissions.find(name => name.id === val);
            return name ? name.name : ''
        },
        getYearsName(val) {
            const name = this.years.find(name => name.id === val);
            return name ? name.name : ''
        },
    }
}
</script>

<style scoped>

</style>
