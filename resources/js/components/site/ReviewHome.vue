<template>
    <div>
        <div v-if="reviews.length > 0">
            <carousel :autoplay="true" :nav="false" :width="100" :margin="10" :items="2">
                <div class="column box" v-for="(review, index) in reviews">
                    <div class="content">
                        <div class="columns">
                            <div class="column">
                                <strong>{{ review.customer.name + ' ' + review.customer.surname }}</strong>
                                <br>
                                (<small>{{ lang.in_site}}{{ getCurrentData(review.customer.created_at) }}</small>)
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <a v-bind:href="'executor/' + review.executor.id">
                                    <strong>{{ review.executor.name }}</strong>
                                </a>
                                - {{ review.description.slice(0, 150) }}...
                                <a v-bind:href="'executor/' + review.executor.id">
                                    <small><span class="mdi mdi-arrow-right-box mdi-18px"></span></small>
                                </a>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <b-rate
                                    v-model=review.rate
                                    :disabled="true"
                                    :show-score="true">
                                </b-rate>
                            </div>
                            <div class="column">
                                <small>{{lang.created_at}}: {{ getCurrentDataTime(review.created_at) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </carousel>
        </div>
        <div v-else>
            <p>{{lang.not_reviews}}</p>
        </div>
    </div>
</template>

<script>
import carousel from 'vue-owl-carousel'

export default {
    name: "ReviewHome",
    components: {carousel},
    props: ['reviews', 'lang'],
    methods: {
        getCurrentDataTime(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },
        getCurrentData(val) {
            return this.$luxon(val, "yyyy-MM-dd")
        },
    }
}
</script>

<style scoped>

</style>
