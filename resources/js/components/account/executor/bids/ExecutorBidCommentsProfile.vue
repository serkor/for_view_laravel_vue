<template>
<div>
    <h4 class="subtitle is-4">
        <span class="mdi mdi-comment-check-outline"></span> {{ lang.comment }}
        <b-tag size="is-medium" rounded>{{ comments.length }}</b-tag>
    </h4>
    <div class="columns">
        <div class="column">
            <b-message v-for="comment in comments" :key="comment.id">
                <div class="columns">
                    <div class="column">
                        <p class="mb-1">{{ comment.text }}</p>
                        <div class="columns">
                            <div class="column">
                                <p class="small">
                                    {{ lang.status }}:
                                    {{ getStatusName(comment.status_id) }}</p>
                            </div>
                            <div class="column">
                                <p class="small">
                                    {{ lang.user }}: {{ comment.user.name }}</p>
                            </div>
                            <div class="column">
                                <p class="small">
                                    {{ getDataFormat(comment.created_at) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </b-message>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "ExecutorBidCommentsProfile",
    props: ['bid', 'lang', 'all_statuses'],
    data(){
        return {
            comments: []
        }
    },
    created() {
        this.getResults()
    },
    methods: {
        getStatusName(val) {
            const status = this.all_statuses.find(status => status.id === val);
            return status ? status.name : ''
        },

        getDataFormat(val) {
            return this.$luxon(val, "yyyy-MM-dd HH:mm")
        },

        getResults() {
            axios.patch('/account/get-list-executor-comments', {
                bid_id: this.bid.id
            }).then(r => {
                this.comments = r.data;
            });
        },

    }
}
</script>

<style scoped>

</style>
