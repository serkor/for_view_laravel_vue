<template>
    <div>
        <h4 class="subtitle is-4">
            <span class="mdi mdi-comment-question-outline"></span>
            {{ lang.questions_answers }}
        </h4>
        <article class="media">
            <div class="media-content">
                <div v-for="question in questions" :key="question.id" class="m-5">
                    <figure :class="getStyle(question.type)">
                        <div class="content">
                            <p>
                                <strong>{{ question.name ? question.name : getNameUser(question) }}</strong>
                                <br>{{ question.text }}<br>
                                <small>{{ getDataFormat(question.created_at) }}</small>
                            </p>
                        </div>
                    </figure>
                </div>
            </div>
        </article>

        <b-pagination
            :total="total"
            :current="current"
            :per-page="perPage"
            :current.sync="current"
            @change="getResults(current)">
        </b-pagination>

        <b-loading
            :is-full-page="isFullPage"
            v-model="isLoading"
            :can-cancel="true">
        </b-loading>

        <hr>
        <article class="media" v-if="isCloseQuestions">
            <div class="media-content">
                <div class="field">
                    <p class="control">
                        <textarea
                            class="textarea"
                            :placeholder="lang.ask"
                            v-model="text">
                        </textarea>
                    </p>
                </div>
                <div class="field">
                    <p class="control">
                        <button @click="sendQuestion" class="button is-dark is-light">{{ lang.send }}</button>
                    </p>
                </div>
            </div>
        </article>

    </div>
</template>

<script>

export default {
    name: "ExecutorBidQuestionsProfile",
    props: ['bid', 'executor', 'lang'],
    data() {
        return {
            name: '',
            text: '',
            created_at: '',
            questions: [],
            total: 100,
            current: 1,
            perPage: 9,
            isLoading: false,
            isFullPage: true,
            isCloseQuestions: true
        }
    },
    created() {
        this.getResults();
    },

    mounted() {
        if (this.bid.status_id !== 1) {
            this.isCloseQuestions = false
        }
    },

    methods: {
        getNameUser(val) {
            if (val.executor) {
                return val.executor.name
            }
            if (val.customer) {
                return val.customer.name
            }
        },

        getResults(page = 1) {
            this.isLoading = true
            axios.patch('/account/get-list-executor-question?page=' + page, {
                bid_id: this.bid.id,
            }).then(r => {
                this.questions = r.data.questions.data;
                this.current = page
                this.total = r.data.all_count
                this.isLoading = false
            });
        },

        getStyle(val) {
            if (val === 3) {
                return 'media-right box'
            } else {
                return 'media-left box'
            }
        },

        getDataFormat(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },

        sendQuestion() {
            axios.patch('/account/store-executor-bid-question', {
                text: this.text,
                executor_id: this.executor.id,
                type: 2,
                bid_id: this.bid.id,
                created_at: this.created_at,
            }).then(r => {
                this.questions.push({
                    name: this.executor.name,
                    text: this.text,
                    created_at: new Date().toISOString(),
                })
                this.getStyle(2)
                this.$buefy.notification.open({
                    message: this.lang.message_is_send,
                    type: 'is-success'
                })
                this.clearForm()
            })
        },

        clearForm() {
            this.text = ''
        },
    }
}
</script>

<style scoped>

</style>
