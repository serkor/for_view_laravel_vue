<template>
    <div>
        <b-button v-if="can"
                  :label="lang.add_review"
                  type="is-dark is-outlined"
                  @click="isReviewModalActive = true"/>

        <b-tooltip v-else position="is-bottom" multilined>
            <b-button
                :label="lang.add_review"
                disabled="true"
                type="is-dark is-outlined"/>
            <template v-slot:content>
                {{ lang.cannot_add_review }}
            </template>
        </b-tooltip>

        <b-modal v-model="isReviewModalActive" :width="640" scroll="keep">
            <div class="card">
                <div class="card-header">
                    <h3>{{ lang.can_add_review }}</h3>
                </div>
                <div class="card-content">
                    <div class="content">
                        <b-field :label="lang.text_review">
                            <b-input maxlength="200"
                                     type="textarea"
                                     v-model="description">
                            </b-input>
                        </b-field>
                        <b-field :label="lang.your_mark">
                            <b-rate
                                v-model="rate"
                                :icon-pack="packs"
                                :icon="icons"
                                :max="maxs"
                                :size="sizes"
                                :locale="locale"
                                :rtl="isRtl"
                                :spaced="isSpaced"
                                :disabled="isDisabled">
                            </b-rate>
                        </b-field>
                        <hr>
                        <b-button
                            :label="lang.add"
                            type="is-success"
                            @click="addReview"
                        />
                        <b-button
                            :label="lang.close"
                            @click="isReviewModalActive = false"/>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "ExecutorReview",
    props: ['executor', 'can', 'lang'],
    data() {
        return {
            description: '',
            isReviewModalActive: false,
            rate: 0,
            maxs: 5,
            sizes: '',
            packs: 'mdi',
            icons: 'star',
            isRtl: false,
            isSpaced: false,
            isDisabled: false,
            locale: undefined, // Browser locale
        }
    },
    methods: {
        addReview() {
            if (this.description !== '') {
                axios.patch('/account/store-customer-review', {
                    description: this.description,
                    rate: this.rate,
                    executor_id: this.executor.id
                }).then(r => {
                    this.isReviewModalActive = false
                    this.$buefy.notification.open({
                        message: this.lang.review_added,
                        type: 'is-success'
                    })
                    this.$root.$emit('sendNewReview', true);
                    this.$root.$emit('getAllCountReviews', r.data);
                    this.clearForm()
                })
            } else {
                this.$buefy.notification.open({
                    message: this.lang.required_text_review,
                    type: 'is-danger'
                })
            }
        },
        clearForm() {
            this.description = ''
            this.rate = 0
        }
    }
}
</script>

<style scoped>

</style>
