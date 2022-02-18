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
            <b-table-column field="mark" :label="lang.mark" v-slot="props">
                {{ props.row.car.mark.name }}
            </b-table-column>
            <b-table-column field="vin" label="VIN" v-slot="props">
                {{ props.row.car.vin }}
            </b-table-column>
            <b-table-column field="offers" :label="lang.offers" v-slot="props">
                <b-tag rounded>{{ props.row.offers.length }}</b-tag>
            </b-table-column>
            <b-table-column field="questions" :label="lang.questions" v-slot="props">
                <b-tag rounded>{{ props.row.questions.length }}</b-tag>
            </b-table-column>
            <b-table-column v-slot="props">
                <a class="button" :href="'customer-bid/' + props.row.id">
                    <span class="mdi mdi-arrow-right-box mdi-24px"></span>
                </a>
            </b-table-column>

            <template #detail="props">
                <article class="media">
                    <div class="media-content">
                        <div class="content">
                            <div class="columns">
                                <div class="column box m-1">

                                    <article class="message is-dark" v-if="props.row.executor_id">
                                        <div class="message-body">
                                            <strong>{{ lang.executor }}: </strong>
                                            <a :href="`/executor/` + props.row.executor.id">
                                                {{ props.row.executor.name }}</a>,
                                            <span class="mdi mdi-phone"></span>
                                            <a :href="'tel:' + props.row.executor.phone">
                                                {{ props.row.executor.phone }}
                                            </a>
                                        </div>
                                    </article>

                                    <div class="columns">
                                        <div class="column is-3">
                                            {{ lang.categories }}:
                                        </div>
                                        <div class="column is-9">
                                            <b-taglist>
                                                <b-tag type="is-text is-light"
                                                       v-for="category in props.row.categories" :key="category.id">
                                                    {{ category.name }}
                                                </b-tag>
                                            </b-taglist>
                                        </div>
                                    </div>

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
                                            {{ lang.type }}:
                                        </div>
                                        <div class="column is-9">
                                            <b-tag :type="class_type">
                                                {{ getType(props.row.type) }}
                                            </b-tag>
                                        </div>
                                    </div>

                                    <div class="columns">
                                        <div class="column is-3">
                                            {{ lang.desired_date }}:
                                        </div>
                                        <div class="column is-9">
                                            {{ props.row.desired_date }}
                                        </div>
                                    </div>

                                    <div class="columns">
                                        <div class="column is-3">
                                            {{ lang.address }}:
                                        </div>
                                        <div class="column is-9">
                                            {{ props.row.city.name }}
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
                            <hr>

                            <div class="buttons">
                                <a class="button is-dark is-light"
                                   :href="'customer-bid/' + props.row.id">
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
    name: "CustomerBidTable",
    props: ['bids', 'customer', 'lang', 'dateSearchable'],
    data() {
        return {
            class_type: 'is-info is-light',
        }
    },

    methods: {
        getType(val) {
            if (val === 1) {
                this.class_type = 'is-danger'
                return this.lang.quickly
            } else {
                return this.lang.default
            }
        },

        getDataFormat(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },
    }
}
</script>

<style scoped>

</style>
