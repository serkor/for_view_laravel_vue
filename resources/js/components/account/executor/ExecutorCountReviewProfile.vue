<template>
    <div>
        {{reviews_count}}
    </div>
</template>

<script>
export default {
    name: "ExecutorCountReviewProfile",
    props:['executor'],
    data(){
        return {
            reviews_count: this.executor.reviews.length
        }
    },
    mounted() {
        this.$root.$on('getAllCountReviews', data => {
            this.reviews_count = data.count
        });
    },
}
</script>

<style scoped>

</style>
