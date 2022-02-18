<template>
    <div>
        <b-table
            :data="bids"
            detailed
            hoverable
            detail-key="id">

            <b-table-column field="id" label="№" sortable v-slot="props" :searchable="dateSearchable">
                {{ props.row.id }}
            </b-table-column>
            <b-table-column field="mark" :label="lang.mark" sortable v-slot="props">
                {{ props.row.car.mark.name }}
            </b-table-column>
            <b-table-column field="category" :label="lang.categories" v-slot="props">
                <b-taglist>
                    <b-tag type="is-text is-light"
                           v-for="category in props.row.categories" :key="category.id">
                        {{ category.name }}
                    </b-tag>
                </b-taglist>
            </b-table-column>
            <b-table-column field="desired_date" :label="lang.desired_date" sortable v-slot="props">
                {{ props.row.desired_date }}
            </b-table-column>
            <b-table-column field="city_id" :label="lang.city" sortable v-slot="props">
                {{ props.row.city.name }}
            </b-table-column>
            <b-table-column field="type" :label="lang.type" sortable v-slot="props">
                <b-tag v-if="props.row.type" type="is-danger">
                    <span>{{ lang.quickly}}</span>
                </b-tag>
                <b-tag v-else type="is-info is-light">
                    <span>{{ lang.default }}</span>
                </b-tag>
            </b-table-column>
            <b-table-column v-slot="props">
                <a class="button" :href="'executor-bid/' + props.row.id">
                    <span class="mdi mdi-arrow-right-box mdi-24px"></span>
                </a>
            </b-table-column>

            <template #detail="props">
                <article class="media">
                    <div class="media-content">
                        <div class="content">
                            <div class="columns">
                                <div class="column">
                                    <div class="columns">
                                        <div class="column box m-1">

                                            <article class="message is-dark"
                                                     v-if="executor.id === props.row.executor_id">
                                                <div class="message-body">
                                                    <strong>{{ lang.customer }}: </strong>
                                                    {{ props.row.customer.name }}
                                                    {{ props.row.customer.surname }},
                                                    <span class="mdi mdi-phone"></span>
                                                    <a :href="'tel:' + props.row.customer.phone">
                                                        {{ props.row.customer.phone }}
                                                    </a>
                                                </div>
                                            </article>

                                            <div class="columns">
                                                <div class="column is-3">
                                                    {{ lang.description }}:
                                                </div>
                                                <div class="column is-9">
                                                    <p>{{ props.row.description }}</p>
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-3">
                                                    {{ lang.mark_model }}:
                                                </div>
                                                <div class="column is-9">
                                                    {{ props.row.car.mark_model.name }}
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-3">
                                                    {{ lang.transmission }}:
                                                </div>
                                                <div class="column is-9">
                                                    {{ props.row.car.transmission.name }}
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-3">
                                                    {{ lang.year }}:
                                                </div>
                                                <div class="column is-9">
                                                    {{ props.row.car.year.name }}
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-3">
                                                    VIN:
                                                </div>
                                                <div class="column is-9">
                                                    {{ props.row.car.vin }}
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-3">
                                                    {{ lang.created_at }}:
                                                </div>
                                                <div class="column is-9">
                                                    {{ getDataFormat(props.row.created_at) }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="buttons">
                                <a class="button is-dark is-light"
                                   :href="'executor-bid/' + props.row.id">
                                    {{ lang.more }}
                                    <span class="ml-2 mdi mdi-arrow-right-box mdi-24px"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

            </template>
        </b-table>

    </div>
</template>

<script>
export default {
    name: "ExecutorBidTable",
    props: ['bids', 'executor', 'lang', 'dateSearchable'],
    methods: {
        getDataFormat(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },
    }
}
</script>

<style scoped>

</style>
